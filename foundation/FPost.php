<?php


class FPost
{
    public static $class = "FPost";

    public static $table = "post";

    public static $value = "(:IDpost,:IDuser,:Title,:Date,:Deleted)";

    public function __constructor()
    {
    }

    public static function bind($statement, EPost $post)
    {
        $statement->bindValue(":IDpost", NULL, PDO::PARAM_INT);
        $statement->bindValue(":IDuser", $post->getUserID(), PDO::PARAM_INT);   //DEVE ESSERE PRESO DALLA CLASSE CONTROL RELATIVA ALLA CREAZIONE DELL'ESPERIENZA
        $statement->bindValue(":Title", $post->getTitle(), PDO::PARAM_STR);
        $statement->bindValue(":Date", $post->getCreationDate(), PDO::PARAM_STR);
        $statement->bindValue(":Deleted", $post->getDeleted(), PDO::PARAM_BOOL);
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

    /** Controlla se nella tabella è già presente il like
     *se non è presente lo aggiunge e ritorna il relativo ID
     *altirmenti ritorna null
     */
    public static function store(EPost $post)
    {
        $database = FDataBase::getInstance();
        $id=$database->storeInDB(self::getClass(),$post);
        return $id;
    }

    /** aggiorna il valore specificato nel campo $field
     * corrsipondente alla chiave $id immessa
     */
    public static function update($field, $newValue, $id)
    {
        $u = false;
        $database = FDataBase::getInstance();
        $exist = $database->existInDB(self::getTable(), "IDpost", $id);
        if ($exist) {
            $u = $database->updateInDB(self::getClass(), $field, $newValue, "IDpost", $id);
            return $u;
        }
        return $u;
    }


    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id
     * @throws Exception
     */
    public static function load($field, $id)
    {
        $post=null;
        $database = FDataBase::getInstance();
        $result = $database->loadById(self::getTable(), $field, $id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
            foreach ($likeList as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }}
            $post = new EPost($result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['Deleted'],$nLike,$nDislike, $result['IDuser']);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $nLike=0;
                    $nDislike=0;
                    if ($likeList!=null){
                    foreach ($likeList as $l){
                        if($l->getValue()==1){
                            $nLike ++;
                        }elseif ($l->getValue()==-1){
                            $nDislike++;
                        }
                    }}
                    $post[] = new EPost($result[$i]['Title'],$commentList,$likeList, $result[$i]['Date'],$travel,$result[$i]['Deleted'],$nLike,$nDislike, $result[$i]['IDuser']);
                    $post[$i]->setPostID($result[$i]['IDpost']);
                }
            }
        }
        return $post;
    }


    /** Se il valore passato in ingresso è maggiore di 0 rstituisce true
     *altrimenti restituisce false
     */
    public static function exist($field, $id)
    {
        $database = FDataBase::getInstance();
        $e = $database->existInDB(self::getTable(), $field, $id);
        if ($e > 0) {
            return true;
        } else {
            return false;
        }
    }


    /** Elimina l'elemento in cui l'id corrisponde a quello
     * inserito nel campo corrispondente al campo field
     */
    public static function delete($field, $id)
    {
        $database = FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(), $field, $id);
    }

    public static function deletePost($id){
        $database=FDataBase::getInstance();
        $database->deleteFromDB(self::getTable(),'IDpost',$id);
    }

    public static function restorePost($id){
        $database=FDataBase::getInstance();
        $database->updateInDB(self::getTable(),"Deleted",false,"IDPost",$id);
    }


    /** Restituisce tutti i valori di place associati a quel post */
    public static function loadPlaceByPost($idPost)
    {   $place=null;
        $database = FDataBase::getInstance();
        $result = $database->loadPlaceToPost($idPost);
        $rows_number = $database->interestedRowsInTable("place_to_post","IDpost",$idPost);
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


    /** restituisce la persona o le persone che hanno reportato quel post */
    public static function loadPostReporter($idPost)
    {   $user=null;
        $database = FDataBase::getInstance();
        $result = $database->loadPostReporter($idPost);
        $rows_number = $database->interestedRowsInTable("post_reported_by_user","IDpost",$idPost);
        if(($result != null) && ($rows_number == 1)) {
            $user = new EUser($result['UserName'],$result['Name'],$result['Password'],$result['Email'],$result['IDimage'],$result['Description'],$result['Reported'],$result['Banned']);
            $user->setUserID($result['IDuser']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $user = array();
                for($i = 0; $i < count($result); $i++){
                    $user[] = new EUser($result[$i]['UserName'],$result[$i]['Name'],$result[$i]['Password'],$result[$i]['Email'],$result[$i]['IDimage'],$result[$i]['Description'],$result[$i]['Reported'],$result[$i]['Banned']);
                    $user[$i]->setUserID($result[$i]['IDuser']);
                }
            }
        }
        return $user;
    }


    /** visualizza tutti i post che possono essere visualizzati */
    public static function loadAllVisiblePost()
    {
        $result = self::load("Deleted", "false");
        return $result;
    }

    /** visualizza tutti i post che possono essere visualizzati
     * @throws Exception
     */
    public static function loadDeletedPosts()
    {   $post=null;
        $database=FDataBase::getInstance();
        $result = self::load("Deleted", true);
        $rows_number = $database->interestedRows(self::getClass(),"Deleted",true);
        $database->closeDbConnection();
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $Like=Flike::load("IDpost",$result['IDpost']);
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
            foreach ($Like as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }}
            $post = new EPost($result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['Deleted'],$nLike,$nDislike, $result['IDpost']);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]->getPostID());
                    $likeList=FLike::load("IDpost",$result[$i]->getPostID());
                    $travel=FTravel::load("IDpost",$result[$i]->getPostID());
                    $Like=Flike::load("IDpost",$result[$i]->getPostID());
                    $nLike=0;
                    $nDislike=0;
                    if ($likeList!=null){
                    foreach ($Like as $l){
                        if($l->getValue()==1){
                            $nLike ++;
                        }elseif ($l->getValue()==-1){
                            $nDislike++;
                        }
                    }}
                    $post[] = new EPost($result[$i]->getTitle(),$commentList,$likeList,$result[$i]->getCreationDate(),$travel,$result[$i]->getDeleted(),$nLike,$nDislike, $result[$i]->getUserID());
                    $post[$i]->setPostID($result[$i]->getPostID());
                }
            }
        }
        return $post;
    }


    public static function updatePlaceAssociatedToPost($idPost,$idPlace){
        $database=FDataBase::getInstance();
        $result=$database->updatePlaceToPost($idPost,$idPlace,2);
        return $result;

    }

    /**
     * @throws Exception
     */
    public static function loadAll(){
        $database = FDataBase::getInstance();
        $result=$database->getAllByTable(self::getTable());
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $travel=FTravel::load("IDpost",$result['IDpost']);
            $Like=Flike::load("IDpost",$result['IDpost']);
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
            foreach ($Like as $l){
                if($l->getValue()==1){
                    $nLike ++;
                }elseif ($l->getValue()==-1){
                    $nDislike++;
                }
            }}
            $post = new EPost($result['Title'],$commentList,$likeList,$result['Date'],$travel,$result['Deleted'],$nLike,$nDislike, $result['IDuser']);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    echo var_dump($result[$i]);
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $travel=FTravel::load("IDpost",$result[$i]['IDpost']);
                    $Like=Flike::load("IDpost",$result[$i]['IDpost']);
                    $nLike=0;
                    $nDislike=0;
                    if ($likeList!=null){
                    foreach ($Like as $l){
                        if($l->getValue()==1){
                            $nLike ++;
                        }elseif ($l->getValue()==-1){
                            $nDislike++;
                        }
                    }}
                    $post[] = new EPost($result[$i]['Title'],$commentList,$likeList,$result[$i]['Date'],$travel,$result[$i]['Deleted'],$nLike,$nDislike, $result[$i]['IDuser']);
                    $post[$i]->setPostID($result[$i]['IDpost']);
                }
            }
        }
        return $post;
    }

    public static function getPostCount(){
        $result = self::load("Deleted", "false");
        $rows_number = count($result);
        return $rows_number;
    }

    public static function getLikeCount(EPost $post){
        return $post->getNLike();
    }


    /** NON FUNZIONA VAFAMMOC A PIERO */
    public static function loadPostHomePage()
    {
        $allPosts = self::loadAllVisiblePost();
        $mostLikedPost = array();
        $toReturn = array();
        $sortable = array();

        if (self::getPostCount() > 0){
            $mostLikedPost[0]= $allPosts[0];
            if (self::getPostCount() > 1){
                $mostLikedPost[1]= $allPosts[1];
                if (self::getPostCount() > 2){
                    $mostLikedPost[2]= $allPosts[2];
                    if (self::getPostCount() > 3){
                        $mostLikedPost[3]= $allPosts[3];
                        if (self::getPostCount() > 4){
                            for($i = 4; $i < count($allPosts); $i++ ){
                                $sortable[$allPosts[$i]] = self::getLikeCount($allPosts[$i]);
                            }
                            arsort($sortable);
                            $sorted = array();
                            $sorted[0] = $sortable[0];
                            $sorted[1] = $sortable[1];
                            $sorted[2] = $sortable[2];
                            $sorted[3] = $sortable[3];
                            foreach ($sorted as $key => $value){
                                $mostLikedPost[] = $key;
                            }
                        } else{
                            $toReturn = $mostLikedPost;
                        }
                    } else{
                        $toReturn = $mostLikedPost;
                    }
                } else{
                    $toReturn = $mostLikedPost;
                }
            } else{
                $toReturn = $mostLikedPost;
            }

            return $toReturn;

        } else{
            return null;
        }
    }

    static function loadReportedPost(){
        $database = FDataBase::getInstance();
        return $database->loadReportedPosts();
    }

    /**
     * @throws Exception
     */
    static function newPost($iduser, $titolo, $data, $deleted){
        $post = new EPost($titolo, array(), array(), $data, null, $deleted, 0, 0 , $iduser);
        self::store($post);
    }

   static function storePlaceAssociatedToPost($idPlace,$idPost){
        $database=FDataBase::getInstance();
        $database->storePlaceToPost($idPlace,$idPost);

    }
}