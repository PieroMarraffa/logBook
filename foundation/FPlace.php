<?php


class FPlace extends FDataBase
{
    public static $class="FPlace";

    public static $table="place";

    public static $value="(:IDplace,:Latitude,:Longitude,:Name,:CountryName)";

    public function __constructor(){}

    public static function bind($statement,EPlace $place){
        $statement->bindValue(":IDplace",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Latitude",$place->getLatitude(), PDO::PARAM_STR);
        $statement->bindValue(":Longitude",$place->getLongitude(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$place->getName(), PDO::PARAM_STR);
        $statement->bindValue(":CountryName",$place->getCountryName(), PDO::PARAM_STR);
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
    public static function getValues()
    {
        return self::$value;
    }


    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EPlace $l){
        $database= FDataBase::getInstance();
        $id=$database->storeInDB(self::getClass(),$l);
        return $id;
    }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDplace", $id );
        if($exist){
            $u=$database->updateInDB(self::getClass(), $field ,$newValue,"IDplace",$id );
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $place=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Latitude'],$result['Longitude'],$result['Name'], $result['CountryName']);
            $place->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Name'], $result[$i]['CountryName']);
                    $place[$i]->setPlaceID($result[$i]['IDplace']);

                }
            }
        }
        return $place;
    }

    /** Restituisce tutti gli oggetti nella tabella place */
    public static function loadAll(){
        $database = FDataBase::getInstance();
        $result=$database->getAllByTable(self::getTable());
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Latitude'],$result['Longitude'],$result['Name'], $result['CountryName']);
            $place->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Name'], $result[$i]['CountryName']);
                    $place[$i]->setPlaceID($result[$i]['IDplace']);
                }
            }
        }
        return $place;
    }

    public function loadPlaceProssimity($lat, $lng, $prossimity){
        $database = FDataBase::getInstance();
        $resultTot=$database->loadPlaceProssimity($lat, $lng, $prossimity);
        $rows_number = $resultTot[1];
        $result = $resultTot[0];
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Latitude'],$result['Longitude'],$result['Name'], $result['CountryName']);
            $place->setPlaceID($result['IDplace']);
            return $place;
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Name'], $result[$i]['CountryName']);
                    $place[$i]->setPlaceID($result[$i]['IDplace']);
                }
                return $place;
            }
        }
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




    /** ritorna tutti gli elementi della categoria associata */
    public static function loadByCategory($idCategory){
        $result=self::load("Category",$idCategory);
        return $result;
    }



}