<?php


class FPlace extends FDataBase
{
    public static $class="FPlace";

    public static $table="place";

    public static $value="(:IDplace,:Latitude,:Longitude,:Nation,:AverageVisitors,:Category)";

    public function __constructor(){}

    public static function bind($statement,EPlace $place){
        $statement->bindValue(":IDPlace",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Latitude",$place->getLatitude(), PDO::PARAM_INT);
        $statement->bindValue(":Longitude",$place->getLongitude(), PDO::PARAM_INT);
        $statement->bindValue(":Nation",$place->getNation(), PDO::PARAM_STR);
        $statement->bindValue(":AverageVisitors",$place->getAverageOfVisitors(), PDO::PARAM_INT);
        $statement->bindValue(":Category",$place->getCategory(), PDO::PARAM_STR);

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
    public static function store(EPlace $l){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDplace",$l->getPlaceId());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$l);
            return $id;
        }
        return null;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDplace",$id->getId());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDplace",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        return $result;
    }

    /** Se il valore passato in ingresso è maggiore di 0 rstituisce true
     *altrimenti restituisce false
     */
    public static function exist($field,$id){
        $database=FDataBase::getInstance();
        $e=$database->existInDB(self::getTable(),$field,$id);
        if($e>0){
            return true;
        }
        else{return false;}
    }


    /** Elimina l'elemento in cui l'id corrisponde a quello inserito */
    public static function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }


    /** Restituisce tutti i luoghi relativi a quella nazione */
    public static function loadByNation($nation){
        $database= FDataBase::getInstance();
        $places=$database->loadById(self::getTable(),"Nation", $nation);
        return $places;
    }

    /** ritorna tutte le esperienze associate a quel determinato luogo passato in ingresso */
    public static function loadExperienceByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"experience");
        return $result;
    }

    /** ritorna tutte i post associati a quel determinato luogo passato in ingresso */
    public static function loadPostByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"post");
        return $result;
    }

    /** ritorna tutte gli utenti associati a quel determinato luogo passato in ingresso */
    public static function loadUserByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"user");
        return $result;
    }

    /** ritorna tutti gli elementi della categoria associata */
    public static function loadByCategory($idCategory){
        $database=FDataBase::getInstance();
        $result=$database->loadById(self::getTable(),"Category",$idCategory);
        return $result;
    }
    /** ritorna tutti gli elementi della categgoria inferiore a quella associata */
    public static function loadLowerCategory($idCategory){
        $result=array();
        for($i=$idCategory;$i>0;$i--){
            array_push($result,self::loadByCategory($i));
        }
        return $result;
    }


}