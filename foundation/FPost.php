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
            $experienceList=FExperience::load("IDpost",$result["IDpost"]);
            $r=self::lowerAndHigherDate($experienceList);
            $startDate=$r[0];
            $finishDate=$r[1];
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
                if(is_object($likeList)){
                    $likeLista=array();
                    $likeLista[]=$likeList;
                }else $likeLista=$likeList;
                foreach ($likeLista as $l){
                    if($l->getValue()==1){
                        $nLike ++;
                    }elseif ($l->getValue()==-1){
                        $nDislike++;
                    }
                }
            }
            $post = new EPost($commentList,$likeList,$result['Date'],$result['Deleted'],$nLike,$nDislike, $result['IDuser'],$result['Title'],$experienceList,$startDate,$finishDate);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $experienceList=FExperience::load("IDpost",$result[$i]["IDpost"]);
                    $r=self::lowerAndHigherDate($experienceList);
                    $startDate=$r[0];
                    $finishDate=$r[1];
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
                    $post[] = new EPost($commentList,$likeList, $result[$i]['Date'],$result[$i]['Deleted'],$nLike,$nDislike, $result[$i]['IDuser'],$result[$i]['Title'],$experienceList,$startDate,$finishDate);
                    $post[$i]->setPostID($result[$i]['IDpost']);
                }
            }
        }
        return $post;
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


    public static function loadPlaceByPost($idPost){
        $place=array();
        $result=FPost::load('IDpost',$idPost);
        $experience= $result->getExperienceList();
        if($experience!=null){
            foreach ($experience as $e) {
                $place[] = $e->getPlace();
            }
        }
        return $place;
    }


    /** restituisce la persona o le persone che hanno reportato quel post */
    public static function loadAllPostIDByUser($idUser)
    {
        $postID = null;
        $database = FDataBase::getInstance();
        $result = $database->loadAllPostIDByUser($idUser);
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)) {
            $postID = $result['IDpost'];
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $postID = array();
                for($i = 0; $i < $rows_number; $i++){
                    $postID[$i] = $result[$i]['IDpost'];
                }
            }
        }
        return $postID;
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


    /** visualizza tutti i post che possono essere visualizzati
     * @throws Exception
     */
    public static function loadAllVisiblePost()
    {
        return self::load("Deleted", "false");
    }

    /** visualizza tutti i post che possono essere visualizzati
     * @throws Exception
     */
    public static function loadDeletedPosts()
    {   $post=null;
        $database=FDataBase::getInstance();
        $result = self::load("Deleted", true);
        $rows_number = $database->interestedRows(self::getClass(),"Deleted",true);
        if(($result != null) && ($rows_number == 1)){
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $experienceList=FExperience::load("IDpost",$result["IDpost"]);
            $r=self::lowerAndHigherDate($experienceList);
            $startDate=$r[0];
            $finishDate=$r[1];
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
                if(is_object($likeList)){
                    $likeLista=array();
                    $likeLista[]=$likeList;
                }else $likeLista=$likeList;
                foreach ($likeLista as $l){
                    if($l->getValue()==1){
                        $nLike ++;
                    }elseif ($l->getValue()==-1){
                        $nDislike++;
                    }
                }
            }
            $post = new EPost($commentList,$likeList,$result['Date'],$result['Deleted'],$nLike,$nDislike, $result['IDuser'],$result['Title'],$experienceList,$startDate,$finishDate);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $experienceList=FExperience::load("IDpost",$result[$i]["IDpost"]);
                    $r=self::lowerAndHigherDate($experienceList);
                    $startDate=$r[0];
                    $finishDate=$r[1];
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
                    $post[] = new EPost($commentList,$likeList, $result[$i]['Date'],$result[$i]['Deleted'],$nLike,$nDislike, $result[$i]['IDuser'],$result[$i]['Title'],$experienceList,$startDate,$finishDate);
                    $post[$i]->setPostID($result[$i]['IDpost']);
                }
            }
        }
        return $post;
    }

    /**
     * @throws Exception
     */
    public static function loadAll(){
        $database = FDataBase::getInstance();
        $result=$database->getAllByTable(self::getTable());
        $rows_number = count($result);
        if(($result != null) && ($rows_number == 1)){
            $commentList=FComment::load("IDpost",$result['IDpost']);
            $likeList=FLike::load("IDpost",$result['IDpost']);
            $experienceList=FExperience::load("IDpost",$result["IDpost"]);
            $r=self::lowerAndHigherDate($experienceList);
            $startDate=$r[0];
            $finishDate=$r[1];
            $nLike=0;
            $nDislike=0;
            if ($likeList!=null){
                if(is_object($likeList)){
                    $likeLista=array();
                    $likeLista[]=$likeList;
                }else $likeLista=$likeList;
                foreach ($likeLista as $l){
                    if($l->getValue()==1){
                        $nLike ++;
                    }elseif ($l->getValue()==-1){
                        $nDislike++;
                    }
                }
            }
            $post = new EPost($commentList,$likeList,$result['Date'],$result['Deleted'],$nLike,$nDislike, $result['IDuser'],$result['Title'],$experienceList,$startDate,$finishDate);
            $post->setPostID($result['IDpost']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $commentList=FComment::load("IDpost",$result[$i]['IDpost']);
                    $likeList=FLike::load("IDpost",$result[$i]['IDpost']);
                    $experienceList=FExperience::load("IDpost",$result[$i]["IDpost"]);
                    $r=self::lowerAndHigherDate($experienceList);
                    $startDate=$r[0];
                    $finishDate=$r[1];
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
                    $post[] = new EPost($commentList,$likeList, $result[$i]['Date'],$result[$i]['Deleted'],$nLike,$nDislike, $result[$i]['IDuser'],$result[$i]['Title'],$experienceList,$startDate,$finishDate);
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


    /**
     * @throws Exception
     */
    public static function loadPostHomePage()
    {
        $allPosts = self::loadAllVisiblePost();
        $Post = array();
        $count=0;
        $end=4;
        if($allPosts!=null) {
            if (is_array($allPosts)){
                if (count($allPosts) < 4) {
                    $end = count($allPosts);
                }
                for ($j = 0; $count < $end; $j++) {
                    $n = rand(0, count($allPosts) - 1);
                    if (!in_array($allPosts[$n], $Post)) {
                        $Post[] = $allPosts[$n];
                        $count++;
                    }
                }
            }else{
                $Post[] = $allPosts;
            }
        }
        return $Post;
    }

    static function loadReportedPost(){
        $database = FDataBase::getInstance();
        return $database->loadReportedPosts();
    }

    /**
     * @throws Exception

    static function newPost($iduser,$data, $deleted){
        $post = new EPost(array(), array(), $data, null, $deleted, 0, 0 , $iduser);
        self::store($post);
    }*/

    static function existAssociationPostPlace($idPost, $idPlace){
        $result = self::loadPlaceByPost($idPost);
        if ($result == null) {return false;}
        elseif (count($result) == 1){
            if ($result->getPlaceID() == $idPlace){
                return true;
            }
            else{
                return false;
            }
        }
        elseif (count($result) > 1){
            foreach ($result as $res){
                if ($res->getPlaceID() == $idPlace){
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public static function loadReportedPosts()
    {
        $database=FDataBase::getInstance();
        $r=$database->loadAllPostReported();
        $result=array();
        if(isset($r['IDpost'])){ $result[]=self::load("IDpost",$r['IDpost']);}
        else{
            if($r!=null) {
                foreach ($r as $c) {
                    $result[] = self::load("IDpost", $c['IDpost']);
                }
            }
        }
        return $result;
    }

    public static function deleteFromPostReported($idPost){
        $database=FDataBase::getInstance();
        $database->deleteFromPostReportedByUser($idPost);
    }


    public static function deleteFromReaction($idPost){
        $database=FDataBase::getInstance();
        $database->deleteFromPostReaction($idPost);
    }

}