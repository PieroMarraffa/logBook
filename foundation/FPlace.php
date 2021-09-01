<?php


class FPlace extends FDataBase
{
    public static $class="FPlace";

    public static $table="place";

    public static $value="(:IDPlace,:Latitude,:Longitude,:Nation,:AverageVisitors)";

    public function __constructor(){}

    public static function bind($statement,EPlace $place){
        $statement->bindValue(":IDPlace",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Latitude",$place->getLatitude(), PDO::PARAM_INT);
        $statement->bindValue(":Longitude",$place->getLongitude(), PDO::PARAM_INT);
        $statement->bindValue(":Nation",$place->getNation(), PDO::PARAM_STR);
        $statement->bindValue(":AverageVisitors",$place->getAverageOfVisitors(), PDO::PARAM_INT);
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
    public static function store(ELuogo $l){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDPlace",$l->getId());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$l);
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
        $exist= $database->existDB(self::getTable(),"IDPlace",$id->getId());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDPlace",$id->getId());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public function loadPlace($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        return $result;
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


    /** Elimina l'elemento in cui l'id corrisponde a quello inserito */
    public function delete($id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),"IDPlace",$id);
    }


    /** Restituisce tutti i luoghi relativi a quella nazione */
    public static function loadByNation($nation){
        $database= FDataBase::getInstance();
        $places=$database->loadById(self::getTable(),"Nation", $nation);
        return $places;
    }

}