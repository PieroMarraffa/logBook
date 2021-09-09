<?php


class FTravel
{
    private static $class="FTravel";

    private static $table="travel";

    private static $value="(:IDtravel,:Title,:IDpost)";



    public function __constructor(){}

    public static function bind($statement,ETravel $travel){
        $statement->bindValue(":IDtravel",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Title",$travel->getTitle(), PDO::PARAM_STR);
        $statement->bindValue(":IDpost",$travel->g, PDO::PARAM_INT);//DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA

    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }


    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }


    /**
     * @return string
     */
    public static function getValue(): string
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EExperience $e){
        $database= FDataBase::getInstance();
        $exist= $database->existDB(self::getTable(),"IDexperience",$e->getExperienceID());
        if(!$exist){
            $id=$database->storeInDB(self::getTable(),$e);
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
        $exist= $database->existDB(self::getTable(),"IDtravel",$id->getID());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDtravel",$id->getID());
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $travel = new ETravel($result['Title'], $result['IDpost']);
            $travel->setId($result['IDtravel']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $travel = array();
                for($i = 0; $i < count($result); $i++){
                    $travel[] = new ETravel($result[$i]['Title'], $result[$i]['IDpost']);
                    $travel[$i]->setId($result[$i]['IDtravel']);
                }
            }
        }
        return $travel;
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


    /** Elimina l'elemento in cui l'id corrisponde a quello
     * inserito nel campo corrispondente al campo field
     */
    public static function delete($field,$id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),$field,$id);
    }

}