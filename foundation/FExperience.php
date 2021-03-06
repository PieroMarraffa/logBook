<?php


class FExperience extends FDataBase
{
    private static $class="FExperience";

    private static $table="experience";

    private static $value="(:IDexperience,:IDpost,:IDplace,:StartDay,:EndDay,:Title,:Description)";

    public function __constructor(){}

    public static function bind($statement,EExperience $experience){
        $statement->bindValue(":IDexperience",NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDpost",$experience->getPostID(), PDO::PARAM_INT); //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":IDplace",$experience->getPlaceID(), PDO::PARAM_INT); //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
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
    public static function getValues()
    {
        return self::$value;
    }

    /** Controlla se nella tabella è già presente il luogo
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EExperience $e){
        $database= FDataBase::getInstance();
            $id=$database->storeInDB(self::getClass(),$e);
            return $id;
        }


    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field,$newValue,$id){
        $u=false;
        $database=FDataBase::getInstance();
        $exist= $database->existInDB(self::getTable(),"IDexperience",$id);
        if($exist){
            $u=$database->updateInDB(self::getClass(),$field,$newValue,"IDexperience",$id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function load($field,$id){
        $experience = array();
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $place = FPlace::load('IDplace', $result['IDplace']);
            $experience []= new EExperience($result['IDpost'], $result['StartDay'], $result['EndDay'],$result['Title'],$place, $result['Description']);
            $experience[0]->setExperienceID($result['IDexperience']);
            $experience[0]->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){

                for($i = 0; $i < count($result); $i++){
                    $place = FPlace::load('IDplace', $result[$i]['IDplace']);
                    $experience[] = new EExperience($result[$i]['IDpost'], $result[$i]['StartDay'], $result[$i]['EndDay'],$result[$i]['Title'],$place, $result[$i]['Description']);
                    $experience[$i]->setExperienceID($result[$i]['IDexperience']);
                    $experience[$i]->setPlaceID($result[$i]['IDplace']);
                }
            }
        }
        return $experience;
    }


    public static function loadAll(){
        $database = FDataBase::getInstance();
        $result=$database->getAllByTable(self::getTable());
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $place = FPlace::load('IDplace', $result['IDplace']);
            $experience []= new EExperience($result['IDpost'], $result['StartDay'], $result['EndDay'],$result['Title'],$place, $result['Description']);
            $experience[0]->setExperienceID($result['IDexperience']);
            $experience[0]->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $place = FPlace::load('IDplace', $result[$i]['IDplace']);
                    $experience[] = new EExperience($result[$i]['IDpost'], $result[$i]['StartDay'], $result[$i]['EndDay'],$result[$i]['Title'],$place, $result[$i]['Description']);
                    $experience[$i]->setExperienceID($result[$i]['IDexperience']);
                    $experience[$i]->setPlaceID($result[$i]['IDplace']);
                }
            }
        }
        return $experience;
    }


    /** Restituisce la lista di tutte le esperienze figlie relative all'ID
     * dell'esperienza padre passato in ingresso

    public static function loadExperienceChild($idParent){
        $field="IDExperienceFather";
        $database=FDataBase::getInstance();
        return $database->loadById(self::getTable(),$field,$idParent);
    }

     */


    public static function loadByPost($idPost){
        $field="IDpost";
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$idPost);
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $placeList=FExperience::loadPlaceByExperience($result['IDexperience']);
            $experience = new EExperience($result['IDpost'], $result['StartDay'], $result['EndDay'],$result['Title'],$placeList, $result['Description']);
            $experience->setExperienceID($result['IDexperience']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $placeList=FExperience::loadPlaceByExperience($result[$i]['IDexperience']);
                    $experience[] = new EExperience($result[$i]['IDpost'], $result[$i]['StartDay'], $result[$i]['EndDay'],$result[$i]['Title'],$placeList, $result[$i]['Description']);
                    $experience[$i]->setExperienceID($result[$i]['IDexperience']);
                }
            }
        }
        return $experience;

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

    /** Restituisce tutti i valori di place associati a quell'esperienza*/
    public static function loadPlaceByExperience($experience){
        $database=FDataBase::getInstance();
        $result = $database->loadById(FPlace::getTable(), 'IDplace', $experience);
        $place= new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Category']);
        $place->setPlaceID($result['IDplace']);
        return $place;
    }


}