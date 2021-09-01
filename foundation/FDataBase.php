<?php


class FDataBase
{
    /**Utilizzo il pattern singelton*/
    private static $instance;
    /** Istanza del PDO */
    private $database;

    private function __construct()
    {
        try{
            $this->database=new PDO(/**Aggiungici la roba che ci manca**/);
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
    public function getInstance(){
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
    public function storeInDB($entity,$object){
        try{
            $this->database->beginTransaction();
            $query="INSERT INTO" . $entity::getTable() . "VALUES" . $entity::getValues();
            $statement= $this->database->prepare($query);
            $entity::bind($statement,$object);
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
     * Se la query ritorna loadBypiù valori viene restituito un array contenente
     * gli oggetti restituiti.
     */
    public function loadById($entity,$field,$id){
        try{
            $query="SELECT * FROM " . $entity . "WHERE " . $field ."=" . $id;
            $statement= $this->database->prepare($query);
            $statement->execute();
            $num=$statement->rowCount();
            if($num == 0){
                $result=null;
            }
            elseif ($num =1){
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
            $result=null;
            $this->database->beginTransaction();
            $exist = $this->existInDB($entity, $field, $id);
            if($exist) {
                $this->database->beginTransaction();
                $query = "DELETE * FROM " . $entity . " WHERE " . $field . " = " . $id;
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
        $query = "SELECT * FROM " . $entity . " WHERE " . $field . " = " . $id;
        $statement=$this->database->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1) return 1;
        else if (count($result) > 1) return count($result);
        $this->closeDbConnection();}
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
     * questi sono presenti all'interno della tabella RegisteredUser del DB.
     *Se si ritorna l'utente associato se no ritorna null
     */
    public function verifiedAccess($email,$password){
        try{
        $class=FRegisteredUser;
        $query="SELECT * FROM ". $class::getTable() . " WHERE email = '" . $email ."' AND password = '" . $password . "'";
        $statement=$this->database->prepare($query);
        $statement->execute();
        $num= $statement->rowCount();
        if($num ==0){
            $result=null;
        }elseif ($num > 0){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
        }
        }catch (PDOException $e) {
            echo "ERROR " . $e->getMessage();
            $this->database->rollBack();
            return null;}
    }

}