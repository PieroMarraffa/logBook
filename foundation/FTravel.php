<?php


class FTravel
{
    private static $class="FTravel";

    private static $table="travel";

    private static $value="(:IDtravel,:Title,:IDpost)";



    public function __constructor(){}

    public static function bind($statement,ETravel $travel){
        $statement->bindValue(":IDtravel",NULL, PDO::PARAM_INT);
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
        $exist= $database->existInDB(self::getTable(),"IDexperience",$e->getExperienceID());
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
        $exist= $database->existInDB(self::getTable(),"IDtravel",$id->getID());
        if($exist){
            $u=$database->updateInDB(self::getTable(),$field,$newValue,"IDtravel",$id->getID());
            return $u;
        }
        return $u;
    }

    public static function lowerAndHigherDate($experienceList){
        $lower=new DateTime("2100-12-31");
        $higher=new DateTime("0000-00-00");
        foreach ($experienceList as $ex){
            if($ex->getStartDay()<$lower){
                $lower=$ex->getStartDay();
            }
            if($ex->getEndDay()>$higher){
                $higher=$ex->getEndDay();
            }
        }
        $return=array($lower,$higher);
        return $return;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id
     * @throws Exception
     */
    public static function load($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $imageList=FImage::load("IDtravel",$result["IDtravel"]);
            $experienceList=FExperience::load("IDtravel",$result["IDtravel"]);
            $r=self::lowerAndHigherDate($experienceList);
            $startDate=$r[0];
            $finishDate=$r[1];
            $travel = new ETravel($result['IDtravel'],$result['IDpost'],$experienceList, $imageList,$startDate,$finishDate);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $travel = array();
                for($i = 0; $i < count($result); $i++){
                    $imageList=FImage::load("IDtravel",$result[$i]["IDtravel"]);
                    $experienceList=FExperience::load("IDtravel",$result[$i]["IDtravel"]);
                    $r=self::lowerAndHigherDate($experienceList);
                    $startDate=$r[0];
                    $finishDate=$r[1];
                    $travel[] = new ETravel($result[$i]['IDtravel'],$result[$i]['IDpost'],$experienceList, $imageList,$startDate,$finishDate);
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