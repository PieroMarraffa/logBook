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
        $statement->bindValue(":IDpost",$travel->getPostID(), PDO::PARAM_INT);//DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA

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
    public static function getValues(): string
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(ETravel $e){
        $database= FDataBase::getInstance();
        $database->storeInDB(self::getClass(),$e);
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDtravel",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDtravel",$id);
            return $u;
        }
        return $u;
    }

    public static function lowerAndHigherDate($experienceList){
        $controllo1="21001231";
        $controllo2="00000000";
        $dateArray = array();
        foreach ($experienceList as $ex){
            $data1 = $ex->getStartDay();
            $data2 = $ex->getEndDay();
            $d1 = explode('-', $data1);
            $d2 = explode('-', $data2);
            $d1 = $d1[0] . $d1[1] . $d1[2];
            $d2 = $d2[0] . $d2[1] . $d2[2];
            $dateArray[$d1] = $data1;
            $dateArray[$d2] = $data2;
        }
        foreach ($dateArray as $d =>$data){
            if ($controllo1 > $d){
                $controllo1 = $data;
            }
        }
        foreach ($dateArray as $d =>$data){
            if ($controllo2 < $d){
                $controllo2 = $data;
            }
        }
        $return=array($controllo1,$controllo2);
        return $return;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id
     * @throws Exception
     */
    public static function load($field,$id){
        $travel=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $imageList=FImage::load("IDtravel",$result["IDtravel"]);
            $experienceList=FExperience::load("IDtravel",$result["IDtravel"]);
            $r=self::lowerAndHigherDate($experienceList);
            $startDate=$r[0];
            $finishDate=$r[1];
            $travel = new ETravel($result['IDpost'],$result['Title'],$experienceList, $imageList,$startDate,$finishDate);
            $travel->setTravelID($result['IDtravel']);

        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $travel = array();
                for($i = 0; $i < count($result); $i++){
                    $imageList=FImage::load("IDtravel",$result[$i]["IDtravel"]);
                    if($imageList==null){
                        $imageList=array();
                    }elseif (gettype($imageList)==EImage::class){
                        $imageList[]=$imageList;
                    }
                    $experienceList=FExperience::load("IDtravel",$result[$i]["IDtravel"]);
                    $r=self::lowerAndHigherDate($experienceList);
                    $startDate=$r[0];
                    $finishDate=$r[1];
                    $travel[] = new ETravel($result[$i]['IDpost'],$result[$i]['Title'],$experienceList, $imageList,$startDate,$finishDate);
                    $travel[$i]->setTravelID($result[$i]['IDtravel']);
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