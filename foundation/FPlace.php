<?php


class FPlace extends FDataBase
{
    public static $class="FPlace";

    public static $table="place";

    public static $value="(:IDplace,:Latitude,:Longitude,:Nation,:AverageVisitors,:Category,:Name)";

    public function __constructor(){}

    public static function bind($statement,EPlace $place){
        $statement->bindValue(":IDPlace",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Latitude",$place->getLatitude(), PDO::PARAM_INT);
        $statement->bindValue(":Longitude",$place->getLongitude(), PDO::PARAM_INT);
        $statement->bindValue(":Nation",$place->getNation(), PDO::PARAM_STR);
        $statement->bindValue(":AverageVisitors",$place->getAverageOfVisitors(), PDO::PARAM_INT);
        $statement->bindValue(":Category",$place->getCategory(), PDO::PARAM_STR);
        $statement->bindValue(":Name",$place->getName(), PDO::PARAM_STR);

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
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Nation'],$result['AverageVisitors'],$result['Category'],$result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Nation'],$result[$i]['AverageVisitors'],$result[$i]['Category'],$result[$i]['IDplace']);
                }
            }
        }
        return $place;
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
        $result=$database->loadById(self::getTable(),"Nation", $nation);
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Nation'],$result['AverageVisitors'],$result['Category'],$result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Nation'],$result[$i]['AverageVisitors'],$result[$i]['Category'],$result[$i]['IDplace']);
                }
            }
        }
        return $place;
    }

    /** ritorna tutte le esperienze associate a quel determinato luogo passato in ingresso */
    public static function loadExperienceByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"experience");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $experience = new EExperience($result['IDtravel'], $result['StartDay'], $result['EndDay'],$result['Title'], $result['Description']);
            $experience->setExperienceID($result['IDexperience']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $experience[] = new EExperience($result['IDtravel'], $result['StartDay'], $result['EndDay'],$result['Title'], $result['Description']);
                    $experience[$i]->setExperienceID($result['IDexperience']);
                }
            }
        }
        return $experience;
    }

    /** ritorna tutte i post associati a quel determinato luogo passato in ingresso */
    public static function loadPostByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"post");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $post = new EPost($result['Author'], $result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['IDpost'],$result['Deleted']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $post[] = new EPost($result[$i]['Author'], $result[$i]['Title'],$commentList,$likeList,$result[$i]['Date'],$travel,$result[$i]['IDpost'],$result[$i]['Deleted']);
                }
            }
        }
        return $post;
    }

    /** ritorna tutte gli utenti associati a quel determinato luogo passato in ingresso */
    public static function loadUserByPlace($idPLace){
        $database=FDataBase::getInstance();
        $result=$database->loadEntityToEntity(self::getTable(),$idPLace,"user");
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $user = new EUser($result['IDuser'],$result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['Image'],$result['Description']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $experience = array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result['IDuser'],$result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['Image'],$result['Description']);
                }
            }
        }
        return $user;
    }

    /** ritorna tutti gli elementi della categoria associata */
    public static function loadByCategory($idCategory){
        $database=FDataBase::getInstance();
        $result=$database->loadById(self::getTable(),"Category",$idCategory);
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Nation'],$result['AverageVisitors'],$result['Category'],$result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Nation'],$result[$i]['AverageVisitors'],$result[$i]['Category'],$result[$i]['IDplace']);
                }
            }
        }
        return $place;
    }


    /** ritorna tutti gli elementi della categgoria inferiore a quella associata */
    public static function loadLowerCategory($idCategory){
        $result=array();
        for($i=$idCategory;$i>0;$i--){
            array_push($result,self::loadByCategory($i));
        }
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Nation'],$result['AverageVisitors'],$result['Category'],$result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Nation'],$result[$i]['AverageVisitors'],$result[$i]['Category'],$result[$i]['IDplace']);
                }
            }
        }
        return $place;
    }


}