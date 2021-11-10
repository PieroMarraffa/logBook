<?php

class FPersistentManager
{
    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance==null){
            self::$instance=new FPersistentManager();

        }

        return self::$instance;
    }

/** forse rimuovere il supreme admin dalle classi che supportano la store */
    public static function store($object){
        $Eclass=get_class($object);
        $Fclass=$Eclass;
        $Fclass[0]="F";
        $id=$Fclass::store($object);
        return $id;
    }

    public static function storeMedia(EImage $image,$nome_file){
        $id=FImage::store($image,$nome_file);
        return $id;
    }

    public static function delete($field,$val,$Fclass){
        $Fclass::delete($field,$val);
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass=="FComment" || $Fclass=="FImage" || $Fclass=="FLike" || $Fclass=="FPost" || $Fclass=="FUser")//AGGIUNGI LE FOUNDATION MAN MANO
            $Fclass::delete($field,$val);
        else
            echo ("METODO NON SUPPORTATO DALLA CLASSE");
    }


    public static function exist($field,$val,$Fclass){
        $result=null;
        $result=$Fclass::exist($field,$val);
        return $result;
    }

    public static function load($field, $val, $Fclass) {
        $ris = $Fclass::load($field,$val);
        return $ris;
    }


    public static function loadAll($Fclass) {
        $ris = $Fclass::loadAll();
        return $ris;
    }


    public static function loadAllPostIDByUser($idUser){
        return FPost::loadAllPostIDByUser($idUser);
    }

    /**
     * @throws Exception
     */
    public static function loadAllPlaceIDByUser($idUser){
        $postID = self::loadAllPostIDByUser($idUser);
        if(isset($postID)) {
            if (count($postID) > 1) {
                $travelID = array();
                foreach ($postID as $p) {
                    $travelID[] = self::loadTravelByPost($p)->getTravelID();
                }
                $placeID = array();
                foreach ($travelID as $t) {
                    $exp = self::loadExperienceByTravel($t);
                    foreach ($exp as $e) {
                        $placeID[] = $e->getPlaceID();
                    }
                }
                return $placeID;
            }
        }return null;
    }


    public static function update($field, $newvalue, $val,$Fclass) {
        $ris = null;
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass=="FComment" || $Fclass=="FImage" || $Fclass=="FLike" || $Fclass=="FPost" || $Fclass=="FUser" || $Fclass=="FTravel")//AGGIUNGI LE FOUNDATION MAN MANO
            $ris = $Fclass::update($field, $newvalue, $val);
        else
            print ("METODO NON SUPPORTATO DALLA CLASSE");
        return $ris;
    }


    public static function loadExperienceByTravel($idTravel){
        $result=FExperience::load("IDtravel",$idTravel);
        return $result;
    }


    /**
     * @throws Exception
     */
    public static function loadTravelByPost($idPost){
        $result=null;
        $result=FTravel::load("IDpost",$idPost);
        return $result;
    }


    /**
     * @throws Exception
     */
    public static function loadUserByPost($idPost){
        $result=null;
        $post = FPost::load("IDpost",$idPost);
        $userID = $post->getUserID();
        $user = FUser::load("IDuser", $userID);
        return $user;
    }


    /**
     * @throws Exception
     */
    public static function loadAdmin($field, $id){
        $result=FAdmin::loadAdmin($field,$id);
        return $result;
    }


    /**
     * @throws Exception
     */
    public static function loadAllPost(){
        $result = FPost::loadAll();
        return $result;
    }



    /**
     * @throws Exception
     */
    public static function getPostByUser($id){
        $result = FPost::load('IDuser', $id);
        return $result;
    }

    /**
     * @throws Exception
     */
    public static function getUserByPost($id){
        $post = FPost::load('IDpost', $id);
        return $post->getUserID();
    }

    /**
     * @throws Exception
     */
    public static function loadPostByPlaceName($name){
        $place=FPlace::load("Name",$name);
        $id=$place->getPlaceID();
        $result = FPlace::loadPostByPlace($id);
        return $result;
    }

    public static function loadUserByPlace($id){
        $result =FPlace::loadUserByPlace($id);
        return $result;
    }

    public static function existAssociationPostPlace($idPost,$idPlace){
        return FPost::existAssociationPostPlace($idPost, $idPlace);
    }

    public static function existAssociationUserPlace($idUser,$idPlace){
        return FUser::existAssociationUserPlace($idUser, $idPlace);
    }

    public static function storePlaceToPost($idPost,$idPlace){
        FPost::storePlaceAssociatedToPost($idPlace,$idPost);
    }

    public static function storePlaceToUser($idUser,$idPlace){
        FUser::storePlaceAssociatedToUser($idPlace,$idUser);
    }

    public static function loadCommentReportedByUser($idUser){
        $result=FUser::loadCommentReportedFromUser($idUser);
        return $result;

    }

    public static function loadPostReportedByUser($idUser){
        $result=FUser::loadPostReportedFromUser($idUser);
        return $result;
    }


    public static function storeCommentReporter($idUser,$idComment){
        FUser::storeCommentReporter($idUser,$idComment);
    }

    public static function storePostReporter($idUser,$idPost){
        FUser::storePostReporter($idUser,$idPost);
    }

    public static function loadCommentReporter($idComment){
        $result=FComment::loadCommentReporter($idComment);
        return $result;
    }

    public static function loadPostReporter($idPost){
        $result=FPost::loadPostReporter($idPost);
        return $result;
    }

    public static function loadLogin($email){
        $result=FUser::loadLogin($email);
        return $result;
    }

    public static function updateExperienceAssociatedToPost($idExperience,$idPlace){
        $result=FExperience::updateExperienceAssociatedToPost($idExperience,$idPlace);
        return $result;
    }

    public static function updatePlaceAssociatedToPost($idPost,$idPlace){
        $result=FPost::updatePlaceAssociatedToPost($idPost,$idPlace);
        return $result;

    }


    public static function loadAllVisibleComment()
    {
        $result = FComment::loadAllVisibleComment();
        return $result;
    }

    public static function loadAllDeletedComment()
    {
        $result = FComment::loadReportedComments();
        return $result;
    }

    public static function loadAllDeletedPost()
    {
        $result = FPost::loadReportedPosts();
        return $result;
    }

    public static function deleteComment($id){
        FComment::delete("IDcomment",$id);}

    public static function restoreComment($id){
        FComment::restoreComment($id);}

    public static function deletePost($id){
        FPost::deletePost($id);
    }

    public static function restorePost($id){
        FPost::restorePost($id);}

    public static function loadAllLikes(){
        $result = FPost::loadAll();
        return $result;
    }

    public static function getPostCount(){
        $result = FPost::getPostCount();
        return $result;
    }

    public static function loadPostHomePage(){
        $result = FPost::loadPostHomePage();
        return $result;
    }

    public static function checkUserCredentials($em, $pw)
    {
        $logged = FUser::checkCredentials($em, $pw);
        return $logged;
    }

    public static function checkAdminCredentials($em, $pw)
    {
        $logged = FAdmin::checkCredentials($em, $pw);
        return $logged;
    }

    public static function checkExistingUser($email){
        $taken = FUser::checkExistingUser($email);
        return $taken;
    }

    public static function loadReportedPosts(){
        return FPost::loadDeletedPosts();
    }

    public static function loadReportedComments(){
        return FComment::loadReportedComments();
    }

    public static function loadReportedUsers(){
        return FPost::loadDeletedPosts();
    }


    public static function reportPost($reportedPostId){
        FPost::loadReportedPost($reportedPostId);
    }

    public static function deleteFromCommentReported($idComment){
        FComment::deleteFromCommentReported($idComment);
    }

    public static function deleteFromPostReported($idPost){
        FPost::deleteFromPostReported($idPost);
    }

    public static function deleteFromReaction($idPost){
        FPost::deleteFromReaction($idPost);
    }

    public static function deleteFromPlaceToPost($idPost){
        FPost::deleteFromPlaceToPost($idPost);
    }

    public static function deleteOneFromPlaceToPost($idPost, $idPlace){
        FPost::deleteOneFromPlaceToPost($idPost, $idPlace);
    }

    public static function deleteOneFromPlaceToUser($userID, $placeID){
        FPost::deleteOneFromPlaceToUser($userID, $placeID);
    }

    public static function deleteAllFromPlaceToUser($userID){
        FPost::deleteAllFromPlaceToUser($userID);
    }


    public static function loadPlaceByUser($idUser){
        $place=array();
        $database=FDataBase::getInstance();
        $result=FPost::load('IDuser',$idUser);
        if($result!=null){
            if(!is_array($result)){
                $res=array();
                $res[]=$result;
            }else $res=$result;
            foreach ($res as $r){
                $p=FPost::loadPlaceByPost($r->getPostID());
                foreach ($p as $pl){
                    $place[]=$pl;
                }
            }
        }
        return $place;
    }

    /**
     * @throws Exception
     */
    public static function loadPostByPlace($idPlace){
        $result = array();
        $experience=self::load('IDplace',$idPlace,FExperience::getClass());
        $travel=array();
        foreach ($experience as $e){
            $travel[]=self::load('IDtravel',$e->getTravelID(),FTravel::getClass());
        }
        foreach ($travel as $t){
            $result=self::load('IDpost',$t->getPostID(),FPost::getClass());
        }
        return $result;
    }
}