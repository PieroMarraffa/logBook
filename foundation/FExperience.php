<?php


class FExperience extends FDataBase
{
    public static $class="FExperience";

    public static $table="experience";

    public static $value="(:IDExperience,:IDExperienceFather,:IDPost,:StartDay,:EndDay,:Title,:Description)";

    public function __constructor(){}

    public static function bind($statement,EExperience $experience){
        $statement->bindValue(":IDExperience",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDExperienceFather",$experience->get, PDO::PARAM_INT); //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDPost",$experience->get, PDO::PARAM_INT);              //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DEL POST
        $statement->bindValue(":StartDay",$experience->getStartDay(), PDO::PARAM_STR);
        $statement->bindValue(":EndDay",$experience->getEndDay(), PDO::PARAM_STR);
        $statement->bindValue(":Title",$experience->getTitle(), PDO::PARAM_STR);
        $statement->bindValue(":Description",$experience->getDescription(), PDO::PARAM_STR);
    }

    /**
     * @return string
     */
    public static function getClass()
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValue()
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EExperience $e){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDExperience",$e->getExperienceID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$e);
            return $id;
        }
        return null;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDExperience",$id->getID());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDPlace",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        return $result;
    }


    /** Restituisce la lista di tutte le esperienze figlie relative all'ID
     * dell'esperienza padre passato in ingresso
     */
    public function loadExperienceChild($idParent){
        $field="IDExperienceFather";
        $database=FDataBase::getInstance();
        return $database->loadById(self::getTable(),$field,$idParent);
    }

    public function loadByPost($idPost){
        $field="IDPost";
        $database=FDataBase::getInstance();
        return $database->loadById(self::getTable(),$field,$idPost);

    }

    /** Se il valore passato in ingresso è maggiore di 0 rstituisce true
     *altrimenti restituisce false
     */
    public function exist($field,$id){
        $database=FDataBase::getInstance();
        $e=$database->existInDB(self::getTable(),$field,$id);
        if($e>0){
            return true;
        }
        else{return false;}
    }


    /** Elimina l'elemento in cui l'id corrisponde a quello
     * inserito nel campo corrispondente al campo field
     */
    public function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }

}