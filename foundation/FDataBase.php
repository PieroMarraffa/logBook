<?php

if(file_exists('config.inc.php')) require_once 'config.inc.php';


class FDataBase
{
    /**Utilizzo il pattern singelton*/
    private static $instance;
    /** Istanza del PDO */
    private $database;

    /** "mysql:dbname=logbook;host=127.0.0.1; charset=utf8;","root","pippo" */

    private function __construct(){
        try{
            $this->database=new PDO("mysql:dbname=".$GLOBALS['database'].";host=127.0.0.1; charset=utf8;", $GLOBALS['username'], $GLOBALS['password']);
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
            self::$instance=new FDataBase();

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
    public function storeInDB($entity,$object){
        try{
            $this->database->beginTransaction();
            $query="INSERT INTO " . $entity::getTable() . " VALUES " . $entity::getValues();
            $statement= $this->database->prepare($query);
            $entity::bind($statement,$object);
            $statement->execute();
            $id = $this->database->lastInsertId();
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
            $query="SELECT * FROM " .$entity ." WHERE " . $field ." = '" . $id."';";
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            }
            elseif ($num ==1){
                $result = $statement->fetch(PDO::FETCH_ASSOC);
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
            $this->database->beginTransaction();
            $exist = $this->existInDB($entity, $field, $id);
            if($exist) {
                $query = "DELETE FROM " . $entity . " WHERE " . $field . " = '" . $id."'";
                $statement = $this->database->prepare($query);
                $statement->execute();
                $this->database->commit();
                $this->closeDbConnection();
                $result = true;
            }
            else{
                $this->closeDbConnection();
                $result=false;
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
        $this->closeDbConnection();
        if (count($result) == 1) return true;
        else if (count($result) > 1) return true;
        else{ return false;}

        }
        catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            return false;
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
            $query = "UPDATE " . $class::getTable() . " SET " . $field . "='" . addslashes($newvalue) . "' WHERE " . $pk . "='" . $id . "';";
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
    public function verifiedAccess($classTable,$email){

        try{
        $query="SELECT * FROM ". $classTable . " WHERE Email = '" . $email ."';";
        $statement=$this->database->prepare($query);
        $statement->execute();
        $num= $statement->rowCount();
        if($num ==0){
            $result=null;
        }
        elseif ($num > 0){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
        }
        }catch (PDOException $e) {
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;}
        return $result;
    }



//----------------------LOAD DA TABELLE CONTENITORE INTERMEDIE--------------------



    public function loadAllPostIDByUser($id){
        try{
            $query="SELECT IDpost FROM post WHERE IDuser = '" . $id."';";
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            }
            elseif ($num ==1){
                $result = $statement->fetch(PDO::FETCH_ASSOC);
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

    public function loadPostReportedbyUser($idUser){
        try{
        $query="SELECT * FROM post_reported_by_user WHERE IDuser ='". $idUser . "';";
        $statement=$this->database->prepare($query);
        $statement->execute();
        $num=$statement->rowCount();
        if($num==0){
            $result=false;
        }elseif ($num==1){
            $x=$statement->fetch(PDO::FETCH_ASSOC);
            $result=$this->loadById("post","IDpost",$x['IDpost']);
        }elseif($num>1){
            $resID=array();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $statement->fetch()) $resID[] = $row;
            $result=array();
            foreach ($resID as $r){
                $result[]=$this->loadById("post","IDpost",$r['IDpost']);
            }
        }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }



    public function loadPlaceProssimity($lat, $lng, $prossimity){
        try{
            $query="SELECT * FROM place WHERE Latitude >= " . $lat . "-" . $prossimity ." AND Latitude <= " . $lat . "+" . $prossimity . " AND Longitude >= " . $lng . "-" . $prossimity . " AND Longitude <= " . $lng . "+" . $prossimity . ";";
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            }
            elseif ($num ==1){
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            }else{
                $result=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) {
                    $result[] = $row;
                }
            }
            $this->closeDbConnection();
            return [$result, $num];
        }catch (PDOException $e){
            echo "ERROR" . $e->getMessage();
            return null;
        }
    }


    public function loadCommentReportedbyUser($idUser){
        try{
            $query="SELECT * FROM comment_reported_by_user WHERE IDuser ='". $idUser . "';";
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num==0){
                $result=false;
            }elseif ($num==1){
                $x=$statement->fetch(PDO::FETCH_ASSOC);
                $result=$this->loadById("comment","IDcomment",$x['IDcomment']);
            }elseif($num>1){
                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) $resID[] = $row;
                $result=array();
                foreach ($resID as $r){
                    $result[]=$this->loadById("comment","IDcomment",$r['IDcomment']);
                }
            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }

    public function loadAllCommentReported(){
        try{
            $query="SELECT * FROM comment_reported_by_user ;";
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num==0){
                $result=false;
            }elseif ($num==1){
                $result=$statement->fetch(PDO::FETCH_ASSOC);
            }elseif($num>1){
                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) $resID[] = $row;
                $result=array();
                foreach ($resID as $r){
                    $result[]=$r;
                }
            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }

    public function loadAllPostReported(){
        try{
            $query="SELECT * FROM post_reported_by_user ;";
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num==0){
                $result=false;
            }elseif ($num==1){
                $result=$statement->fetch(PDO::FETCH_ASSOC);
            }elseif($num>1){
                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) $resID[] = $row;
                $result=array();
                foreach ($resID as $r){
                    $result[]=$r;
                }
            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }


    public function loadPostReporter($idPost){
        try{
            $query="SELECT * FROM post_reported_by_user WHERE IDpost ='". $idPost . "';";
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num==0){
                $result=false;
            }elseif ($num==1){
                $x=$statement->fetch(PDO::FETCH_ASSOC);
                $result=$this->loadById("user","IDuser",$x['IDuser']);
            }elseif($num>1){
                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) $resID[] = $row;
                $result=array();
                foreach ($resID as $r){
                    $result[]=$this->loadById("user","IDuser",$r['IDuser']);
                }
            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }

    public function loadCommentReporter($idComment){
        try{
            $query="SELECT * FROM comment_reported_by_user WHERE IDcomment ='". $idComment . "';";
            $statement=$this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num==0){
                $result=false;
            }elseif ($num==1){
                $result=$statement->fetch(PDO::FETCH_ASSOC);
            }elseif($num>1){

                $resID=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) $resID[] = $row;
                $result=array();
                foreach ($resID as $r){
                    $result[]=$r;
                }
            }
            return $result;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }

    }


//---------------------STORE IN TABELLE CONTENITORE INTERMEDIE--------------------


/** metodi per aggiungere elementi alle classi intermedie del database */


    public function storeCommentReportedByUser($idComment,$idUser){
        try{
            $this->database->beginTransaction();
            $this->database->query("INSERT INTO comment_reported_by_user (IDcomment,IDuser) VALUES(" . $idComment . ",". $idUser.");" );
            $this->database->commit();
            $this->closeDbConnection();
            return true;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return false;
        }
    }

    public function storePostReportedByUser($idPost,$idUser){
        try{
            $this->database->beginTransaction();
            $this->database->query("INSERT INTO post_reported_by_user (IDpost,IDuser) VALUES(" . $idPost . ",". $idUser.");" );
            $this->database->commit();
            $this->closeDbConnection();
            return true;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return false;
        }
    }


//---------------------UPDATE IN TABELLE CONTENITORE INTERMEDIE--------------------

    public function updateCommentReportedByUser($idComment,$idUser,$valoreDaModificare){
        try{

            if($valoreDaModificare==1){
                $exist=self::existInDB("comment_reported_by_user","IDuser",$idUser);
                if($exist){
                    $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE comment_reported_by_user SET IDcomment= ". $idComment. " WHERE IDuser = ". $idUser .";" );}}
            elseif($valoreDaModificare==2){
                $exist=self::existInDB("comment_reported_by_user","IDcomment",$idComment);
                if($exist){
                    $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE comment_reported_by_user SET IDuser = ". $idUser. " WHERE IDcomment = ". $idComment .";" );}}
            else{return null;}
            $this->database->commit();
            $this->closeDbConnection();
            return true;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return false;
        }
    }

    public function updatePostReportedByUser($idPost,$idUser,$valoreDaModificare){
        try{

            if($valoreDaModificare==1){
                $exist=self::existInDB("post_reported_by_user","IDuser",$idUser);
                if($exist){
                    $this->database->beginTransaction();
                $id=$this->database->query(" UPDATE post_reported_by_user SET IDpost= ". $idPost. " WHERE IDuser = ". $idUser .";" );}}
            elseif($valoreDaModificare==2){
                $exist=self::existInDB("post_reported_by_user","IDpost",$idPost);
                if($exist){
                    $this->database->beginTransaction();
                    $this->database->query(" UPDATE post_reported_by_user SET IDuser = ". $idUser. " WHERE IDpost = ". $idPost .";" );}}
            else{return null;}
            $this->database->commit();
            $this->closeDbConnection();
            return true;
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return false;
        }
    }

//----------------------------------------DELETE DALLE TABELLE CONTENITORE------------------------------------


    public function deleteFromCommentReportedByUser($idComment){
        try{
            $this->database->beginTransaction();
                $query = "DELETE FROM comment_reported_by_user WHERE IDcomment = '" . $idComment ."';";
                $statement = $this->database->prepare($query);
                $statement->execute();
                $this->database->commit();
                $this->closeDbConnection();
                $result = true;

        }catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            $this->database->rollBack();
            $result= false;
        }
        return $result;
    }


    public function deleteFromPostReportedByUser($idPost){
        try{
            $this->database->beginTransaction();
            $query = "DELETE FROM post_reported_by_user WHERE IDpost = '" . $idPost ."';";
            $statement = $this->database->prepare($query);
            $statement->execute();
            $this->database->commit();
            $this->closeDbConnection();
            $result = true;

        }catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            $this->database->rollBack();
            $result= false;
        }
        return $result;
    }


    public function deleteFromPostReaction($idPost){
        try{
            $this->database->beginTransaction();
            $query = "DELETE FROM reaction WHERE IDpost = '" . $idPost ."';";
            $statement = $this->database->prepare($query);
            $statement->execute();
            $this->database->commit();
            $this->closeDbConnection();
            $result = true;

        }catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            $this->database->rollBack();
            $result= false;
        }
        return $result;
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
                $result=array();
                $result[] = $statement->fetch(PDO::FETCH_ASSOC);
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

    //----------------RIGHE INTERESSATE DA UNA QUERY------------------
    /**   Metodo che restituisce il numero di righe ineteressate dalla query
     * @param class classe interessata
     *@param field campo usato per la ricerca
     *@param id ,id usato per la ricerca
     */
    public function interestedRows ($class, $field, $id)
    {
        try {
            $this->database->beginTransaction();
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "';";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $this->database->commit();
            $num = $stmt->rowCount();
            $this->closeDbConnection();
            return $num;
        } catch (PDOException $e) {
            echo "ERRORE: " . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }

    public function interestedRowsInTable ($class, $field, $id)
    {
        try {
            $this->database->beginTransaction();
            $query = "SELECT * FROM " . $class . " WHERE " . $field . "='" . $id . "';";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            $this->closeDbConnection();
            return $num;
        } catch (PDOException $e) {
            echo "ERRORE: " . $e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }

    public function storeMediaInDB ($class , $obj,$nome_file) {
        try {
            $this->database->beginTransaction();
            $query = "INSERT INTO ".$class::getTable()." VALUES ".$class::getValues();
            $stmt = $this->database->prepare($query);
            $class::bind($stmt,$obj,$nome_file);
            $stmt->execute();
            $id=$this->database->lastInsertId();
            $this->database->commit();
            $this->closeDbConnection();
            return $id;
        }
        catch(PDOException $e) {
            echo "ERRORE: ".$e->getMessage();
            $this->database->rollBack();
            return null;
        }
    }
}