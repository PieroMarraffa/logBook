<?php



/** DEVI AGGIUNGERE LA ROBA DI INSTALLAZIONE CHE CREA IL FILE CONFIG E SFRUTTA IL COCKIE DI ACCESSO */

/** RICORDIAMOCI DI CONTROLLARE SE I COOKIE SONO ABILITATI O NO E SE NON SONO ABILITATI NOTIFICARLO ALL'UTENTE PERCHE SENNO'
 *L'APPLICAZIONE NON FUNZIONA
 */

class FDataBase
{
    /**Utilizzo il pattern singelton*/
    private static $instance;
    /** Istanza del PDO */
    private $database;

    public function __construct()
    {
        try{
            $this->database=new PDO("mysql:dbname=logBook; host=127.0.0.1; charset=utf8;", 'root', 'pippo');
        }
        catch(PDOException $e){
           echo "ERROR". $e->getMessage();
           die;
        }
    }


    /** unico metodo accessibile dall'esterno per l'accesso al database
     *RICHIAMARE SEMPRE QUESTO
     *Se non è ancora stato istanziato il db lo istanzia.
     */
    public static function getInstance(){
        if(self::$instance==null){
            self::$instance==new FDataBase();
        }
        return self::$instance;
    }

    /**  Metodo che chiude la connesione con il db */
    public function closeDbConnection ()
    {
        static::$instance = null;
    }


    /** Inserisce nel DB in all'interno della tabella selezionata
     * ($entity) l'oggetto passato in ingresso ($object)
     */
    public function storeInDB($foundation, $object){
        try{
            echo $foundation::getValues();
            $this->database->beginTransaction();
            $query="INSERT INTO " . $foundation::getTable() . "VALUES " . $foundation::getValues();
            $statement= $this->database->prepare($query);
            $foundation::bind($statement,$object);
            $statement->execute();
            $id=$this->database->lastInsertId();
            $this->database->commit();
            $this->closeDbConnection();
            return $id;
        }catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }

    /** Restituisce un'elemento del database dalla tabella ($entity)
     * in cui il campo specificato ($field) corrisponde al valore
     * dato in ingresso ($id).
     * Se il valore restituito è unico viene restituito solo l'oggetto.
     * Se la query ritorna più valori viene restituito un array contenente
     * gli oggetti restituiti.
     */
    public function loadById($entity,$field,$id){
        try{
            $query="SELECT * FROM " . $entity . " WHERE " . $field ." = '" . $id."';";
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            }else{
                $result=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch())
                    $result[] = $row;
            }
            $this->closeDbConnection();
            return $result;
        }catch (PDOException $e){
            echo "ERROR" . $e->getMessage();
            return null;
        }
    }


    /** Elimina un'elemento del database dalla tabella ($entity)
     * in cui il campo specificato ($field) corrisponde al valore
     * dato in ingresso ($id). */
    public function deleteFromDB($entity,$field,$id){
        try{
            $result=null;
            $this->database->beginTransaction();
            $exist = $this->existInDB($entity, $field, $id);
            if($exist) {
                $this->database->beginTransaction();
                $query = "DELETE * FROM " . $entity . " WHERE " . $field . " = '" . $id."'";
                $statement = $this->database->prepare($query);
                $statement->execute();
                $this->database->commit();
                $this->closeDbConnection();
                $result = true;
            }
        }catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            $this->database->rollBack();
            $result= false;
        }
        return $result;
    }

    /** Prende in ingresso il nome della tabella($entity)
     *il campo ($field) e il valore da cercare in quel campo ($id)
     *Se il valore esiste nel campo cercato ritorna il numero di volte
     *in cui questo si ripete.
     */
    public function existInDB($entity,$field,$id){
        try{
        $query = "SELECT * FROM " . $entity . " WHERE " . $field . " = '" . $id."';";
        $statement=$this->database->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1) return 1;
        else if (count($result) > 1) return count($result);
        $this->closeDbConnection();
        }
        catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            return null;
        }
    }


    /**Permette di aggiornare l'elemento della tabella ($entity) nel campo ($field)
     * con il valore ($newvalue) in corrispondenza del campo in cui la chiave primaria ($pk)
     *corrisponde al valore immesso nel campo ($id).
     */
    public function updateInDB ($class, $field, $newvalue, $pk, $id)
    {
        try {
            $this->database->beginTransaction();
            $query = "UPDATE " . $class::getTable() . " SET " . $field . "='" . $newvalue . "' WHERE " . $pk . "='" . $id . "';";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $this->database->commit();
            $this->closeDbConnection();
            return true;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->database->rollBack();
            return false;
        }
    }


    /** Dati in ingresso i dati ($email e $password) la query va a verificare se
     * i dati inseriti corrispondono a quelli del Supreme_admin altrimenti va a controllare
     * se questi sono presenti all'interno della tabella RegisteredUser del DB.
     *Se si ritorna l'utente associato se no ritorna null
     */
    public function verifiedAccess($classTable,$email,$password){

        try{
        $query="SELECT * FROM ". $classTable . " WHERE Email = '" . $email ."' AND Password = '" . $password . "';";
        $statement=$this->database->prepare($query);
        $statement->execute();
        $num= $statement->rowCount();
        if($num ==0){
            $result=null;
        }
        elseif ($num > 0){
            $result=$statement->fetch(PDO::FETCH_ASSOC); /** DEVI DISTINGUERE IL LOGIN DEL SUPREME ADMIN DA QUELLO DELL'UTENTE NORMALI */
        }
        }catch (PDOException $e) {
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;}
        return $result;
    }



    /** Prende in ingresso il nome di due tabelle e l'id da cercare
     *va a cercare nella classe entity1_to_entity2 e restituisce l'id associato,
     * utilizzando quel/quegli ID va a cercare nella tabella entity2  gli elementi
     * associati a quell'ID e li restituisce
     * N.B. le combinazioni ammesse sono
     * entity1= place => entity2=experience
     * entity1= place => entity2=post
     * entity1= place => entity2=user
     */
    public function loadEntityToEntity($firstClass,$idFirstClass,$secondClass){
        if($firstClass=="place" && ($secondClass=="experience" || $secondClass=="post" || $secondClass=="user")){
        try{
            $query="SELECT * FROM " . $firstClass . "_to_" . $secondClass . " WHERE ". "ID".$firstClass . "='". $idFirstClass . "';" ;
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $resID=null;
            }
            elseif ($num ==1){
                $resID = $statement->fetch(PDO::FETCH_ASSOC);
                $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $resID ."';";
                $stmt=$this->database->prepare($query);
                $stmt->execute();
                $number=$stmt->rowCount();
                if($number == 0){
                    $result=null;
                }
                elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                else{
                    $result=array();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $stmt->fetch())
                        $result[] = $row;
                }
            }
            else{
                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch())
                    $resID[] = $row;
                foreach ($resID as $r){
                    $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $r ."';";
                    $stmt=$this->database->prepare($query);
                    $stmt->execute();
                    $number=$stmt->rowCount();
                    if($number == 0){
                        $result=null;
                    }
                    elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                    else{
                        $result=array();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row = $stmt->fetch())
                            $result[] = $row;
                    }
                }
            }
            $this->closeDbConnection();
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }}
        elseif($secondClass=="place" && ($firstClass=="experience" || $firstClass=="post" || $firstClass=="user")){
            try{
                $query="SELECT * FROM " . $secondClass . "_to_" . $firstClass . " WHERE ". "ID".$firstClass . "='". $idFirstClass . "';" ;
                $statement=$this->database->prepare($query);
                $statement->execute();
                $num=$statement->rowCount();
                if($num == 0){
                    $resID=null;
                }
                elseif ($num ==1){
                    $resID = $statement->fetch(PDO::FETCH_ASSOC);
                    $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $resID ."';";
                    $stmt=$this->database->prepare($query);
                    $stmt->execute();
                    $number=$stmt->rowCount();
                    if($number == 0){
                        $result=null;
                    }
                    elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                    else{
                        $result=array();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row = $stmt->fetch())
                            $result[] = $row;
                    }
                }
                else{
                    $resID=array();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $statement->fetch())
                        $resID[] = $row;
                    foreach ($resID as $r){
                        $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $r ."';";
                        $stmt=$this->database->prepare($query);
                        $stmt->execute();
                        $number=$stmt->rowCount();
                        if($number == 0){
                            $result=null;
                        }
                        elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                        else{
                            $result=array();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())
                                $result[] = $row;
                        }
                    }
                }
                $this->closeDbConnection();
                return $result;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }

        }
    }

    /** seleziona tutti gli id dei post segnalati senza doppioni
     */
    public function loadReportedPosts(){
        try {
            $query="SELECT DISTINCT IDpost FROM post_reported_by_user" ;
            $statement = $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){

                $result=null;

            } elseif ($num==1){

                $result=$statement->fetch(PDO::FETCH_ASSOC);

            } else{

                $result=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch())
                    $result[] = $row;

            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    /** Prende in ingresso il nome di due tabelle e l'id da cercare
     *va a cercare nella classe entity1_to_entity2 e restituisce l'id associato,
     * utilizzando quel/quegli ID va a cercare nella tabella entity2  gli elementi
     * associati a quell'ID e li restituisce
     * N.B. le combinazioni ammesse sono
     * entity1= comment => entity2=user
     * entity1= post => entity2=user
     */
    public function loadEntityReportedByEntity($firstClass,$idFirstClass,$secondClass){
        if($secondClass=="user" && ($firstClass=="comment" || $firstClass=="post")){
            try{
                $query="SELECT * FROM " . $firstClass . "_reported_by_" . $secondClass . " WHERE ". "ID".$firstClass . "='". $idFirstClass . "';" ;
                $statement=$this->database->prepare($query);
                $statement->execute();
                $num=$statement->rowCount();
                if($num == 0){
                    $resID=null;
                }
                elseif ($num ==1){
                    $resID = $statement->fetch(PDO::FETCH_ASSOC);
                    $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $resID ."';";
                    $stmt=$this->database->prepare($query);
                    $stmt->execute();
                    $number=$stmt->rowCount();
                    if($number == 0){
                        $result=null;
                    }
                    elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                    else{
                        $result=array();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row = $stmt->fetch())
                            $result[] = $row;
                    }
                }
                else{
                    $resID=array();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $statement->fetch())
                        $resID[] = $row;
                    foreach ($resID as $r){
                        $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $r ."';";
                        $stmt=$this->database->prepare($query);
                        $stmt->execute();
                        $number=$stmt->rowCount();
                        if($number == 0){
                            $result=null;
                        }
                        elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                        else{
                            $result=array();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())
                                $result[] = $row;
                        }
                    }
                }
                $this->closeDbConnection();
                return $result;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }}
        elseif($firstClass="place" && ($secondClass=="comment" || $secondClass=="post")){
            try{
                $query="SELECT * FROM " . $secondClass . "_reported_by_" . $firstClass . " WHERE ". "ID".$firstClass . "='". $idFirstClass . "';" ;
                $statement=$this->database->prepare($query);
                $statement->execute();
                $num=$statement->rowCount();
                if($num == 0){
                    $resID=null;
                }
                elseif ($num ==1){
                    $resID = $statement->fetch(PDO::FETCH_ASSOC);
                    $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $resID ."';";
                    $stmt=$this->database->prepare($query);
                    $stmt->execute();
                    $number=$stmt->rowCount();
                    if($number == 0){
                        $result=null;
                    }
                    elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                    else{
                        $result=array();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row = $stmt->fetch())
                            $result[] = $row;
                    }
                }
                else{
                    $resID=array();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row = $statement->fetch())
                        $resID[] = $row;
                    foreach ($resID as $r){
                        $query="SELECT * FROM " . $secondClass . " WHERE " . "ID".$secondClass . "='". $r ."';";
                        $stmt=$this->database->prepare($query);
                        $stmt->execute();
                        $number=$stmt->rowCount();
                        if($number == 0){
                            $result=null;
                        }
                        elseif ($number==1){$result=$stmt->fetch(PDO::FETCH_ASSOC);}
                        else{
                            $result=array();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row = $stmt->fetch())
                                $result[] = $row;
                        }
                    }
                }
                $this->closeDbConnection();
                return $result;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }

        }
    }


/** metodi per aggiungere elementi alle classi intermedie del database */

public function storeEntityToEntity($firstClass,$idFirstClass,$secondClass,$idSecondClass){
    if($firstClass="place" && ($secondClass=="experience" || $secondClass=="post" || $secondClass=="user")){
        try{
            $this->database->beginTransaction();
            $id=$this->database->query("INSERT INTO " .$firstClass. "_to_". $secondClass . "(ID". $firstClass .",ID". $secondClass. ") VALUES(" . $idFirstClass . ",". $idSecondClass .");" );
            $this->database->commit();
            $this->closeDbConnection();
            return $id;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }
    elseif($secondClass=="place" && ($firstClass=="experience" || $firstClass=="post" || $firstClass=="user")){
        try{
            $this->database->beginTransaction();
            $id=$this->database->query("INSERT INTO " .$secondClass. "_to_". $firstClass . "(ID". $secondClass  .",ID". $firstClass. ") VALUES(" . $idSecondClass . ",". $idFirstClass .");" );
            $this->database->commit();
            $this->closeDbConnection();
            return $id;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }
    else{
        echo "LA CLASSE INSERITA NON E' VALIDA " ;
        return null;

    }
}


    public function storeEntityReportedByEntity($firstClass,$idFirstClass,$secondClass,$idSecondClass){
        if($secondClass="user" && ($firstClass=="comment" || $firstClass=="post")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query("INSERT INTO " .$firstClass. "_reported_by_". $secondClass . "(ID". $firstClass .",ID". $secondClass. ") VALUES(" . $idFirstClass . ",". $idSecondClass .");" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        elseif($firstClass=="user" && ($secondClass=="comment" || $secondClass=="post")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query("INSERT INTO " .$secondClass. "_reported_by_". $firstClass . "(ID". $secondClass  .",ID". $firstClass. ") VALUES(" . $idSecondClass . ",". $idFirstClass .");" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        else{
            echo "LA CLASSE INSERITA NON E' VALIDA " ;
            return null;

        }
    }


    public function updateEntityToEntity($firstClass,$idDaMantenere,$secondClass,$idDaModificare){
        if($firstClass="place" && ($firstClass=="comment" || $firstClass=="post")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE " .$firstClass. "_to_". $secondClass . " SET ID". $secondClass ."= '". $idDaModificare. " WHERE ID" . $firstClass . " = '". $idDaMantenere ."';" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        elseif($secondClass=="place" && ($firstClass=="comment" || $firstClass=="post")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE " .$secondClass. "_to_". $firstClass . " SET ID". $secondClass ."= '". $idDaModificare. " WHERE ID" . $firstClass . " = '". $idDaMantenere ."';" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        else{
            echo "LA CLASSE INSERITA NON E' VALIDA " ;
            return null;

        }
    }



    public function updateEntityReportedByEntity($firstClass,$idDaMantenere,$secondClass,$idDaModificare){
        if($firstClass="user" && ($secondClass=="experience" || $secondClass=="post" || $secondClass=="user")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE " .$firstClass. "_reported_by_". $secondClass . " SET ID". $secondClass ."= '". $idDaModificare. " WHERE ID" . $firstClass . " = '". $idDaMantenere ."';" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        elseif($secondClass=="user" && ($firstClass=="experience" || $firstClass=="post" || $firstClass=="user")){
            try{
                $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE " .$secondClass. "_reported_by_". $firstClass . " SET ID". $secondClass ."= '". $idDaModificare. " WHERE ID" . $firstClass . " = '". $idDaMantenere ."';" );
                $this->database->commit();
                $this->closeDbConnection();
                return $id;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                $this->database->rollBack();
                return null;
            }
        }
        else{
            echo "LA CLASSE INSERITA NON E' VALIDA " ;
            return null;

        }
    }

    public function getAllByTable($table){
        try {
            $query="SELECT * FROM " . $table . ";";
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            } elseif ($num ==1){
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            }else{
                $result=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch())
                    $result[] = $row;
            }
            $this->closeDbConnection();
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }
}