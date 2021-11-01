<?php


class FPlace extends FDataBase
{
    public static $class="FPlace";

    public static $table="place";

    public static $value="(:IDplace,:Latitude,:Longitude,:Category,:Name)";

    public function __constructor(){}

    public static function bind($statement,EPlace $place){
        $statement->bindValue(":IDplace",NULL, PDO::PARAM_INT);
        $statement->bindValue(":Latitude",$place->getLatitude(), PDO::PARAM_INT);
        $statement->bindValue(":Longitude",$place->getLongitude(), PDO::PARAM_INT);
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
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Category']);
            $place->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Category']);
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
            $place = new EPlace($result['Name'],$result['Latitude'],$result['Longitude'],$result['Category']);
            $place->setPlaceID($result['IDplace']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $place = array();
                for($i = 0; $i < count($result); $i++){
                    $place[] = new EPlace($result[$i]['Name'],$result[$i]['Latitude'],$result[$i]['Longitude'],$result[$i]['Category']);
                    $place[$i]->setPlaceID($result[$i]['IDplace']);
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



    /** ritorna tutte le esperienze associate a quel determinato luogo passato in ingresso */
    public static function loadExperienceByPlace($idPLace){
        $result=FExperience::load("IDplace",$idPLace);
        return $result;
    }

    /** ritorna tutte i post associati a quel determinato luogo passato in ingresso
     * @throws Exception
     */
    public static function loadPostByPlace($idPLace){
        $post=null;
        $database=FDataBase::getInstance();
        $result=$database->loadPostToPlace($idPLace);
        $rows_number = $database->interestedRowsInTable("place_to_post","IDplace",$idPLace);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $nLike=0;
            $nDislike=0;
            if(is_array($likeList)){
            foreach ($likeList as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }}else $likeList=array();
            $post = new EPost($result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['Deleted'],$nLike,$nDislike,$result['IDuser']);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post= array();
                for($i = 0; $i <= count($result)-1; $i++) {
                    if ($result[$i]){
                        $commentList = FComment::load("IDpost", $result[$i]['IDpost']);
                        $likeList = FLike::load("IDpost", $result[$i]['IDpost']);
                        $travel = FTravel::load("IDpost", $result[$i]['IDpost']);
                        $Like = FLike::load("IDpost", $result[$i]['IDpost']);
                        $nLike = 0;
                        $nDislike = 0;
                        if ($likeList != null) {
                            foreach ($Like as $l) {
                                if ($l->getValue() == 1) {
                                    $nLike++;
                                } elseif ($l->getValue() == -1) {
                                    $nDislike++;
                                }
                            }
                        }
                        $post[] = new EPost($result[$i]['Title'], $commentList, $likeList, $result[$i]['Date'], $travel, $result[$i]['Deleted'], $nLike, $nDislike, $result[$i]['IDuser']);
                        $post[$i]->setPostID($result[$i]['IDpost']);
                    }
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
            $user = new EUser($result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['IDimage'],$result['Description'],$result['Reported'],$result['Banned']);
            $user->setUserID($result['IDuser']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $user= array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result[$i]['UserName'],$result[$i]['Name'],$result[$i]['Password'],$result[$i]['Email'],$result[$i]['IDimage'],$result[$i]['Description'],$result[$i]['Reported'],$result[$i]['Banned']);
                    $user[$i]->setUserID($result[$i]['IDuser']);

                }
            }
        }
        return $user;
    }

    /** ritorna tutti gli elementi della categoria associata */
    public static function loadByCategory($idCategory){
        $result=self::load("Category",$idCategory);
        return $result;
    }


    /** ritorna tutti gli elementi della categgoria inferiore a quella associata
     non funziona perchè le categorie non sono numeri come dovrebbero essere*/
    public static function loadLowerCategory($idCategory){
        $result=array();
        for($i=$idCategory;$i>0;$i--){
            array_push($result,self::loadByCategory($i));
        }
        return $result;
    }


}