<?php

class FPersistentManager
{
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
            print ("METODO NON SUPPORTATO DALLA CLASSE");
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


    public static function update($field, $newvalue, $val,$Fclass) {
        $ris = null;
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass=="FComment" || $Fclass=="FImage" || $Fclass=="FLike" || $Fclass=="FPost" || $Fclass=="FUser")//AGGIUNGI LE FOUNDATION MAN MANO
            $ris = $Fclass::update($field, $newvalue, $val);
        else
            print ("METODO NON SUPPORTATO DALLA CLASSE");
        return $ris;
    }


    public static function loadExperienceByTravel($idTravel){
        $result=null;
        $result=FExperience::load("IDtravel",$idTravel);
        return $result;
    }


    public static function loadTravelByPost($idPost){
        $result=null;
        $result=FTravel::load("IDpost",$idPost);
        return $result;
    }


    public static function loadAdmin($field,$id){
        $result=FAdmin::loadAdmin($field,$id);
        return $result;
    }


    public static function loadAllPost(){
        $result = FPost::loadAll();
        return $result;
    }

    /**
     * @throws Exception
     */
    public static function loadPostByPlace($id){
        $result = FPlace::loadPostByPlace($id);
        return $result;
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

    public static function loadPlaceByPost($idPost){
        $result=FPost::loadPlaceByPost($idPost);
        return $result;
    }

    public static function loadPlaceByUser($idUser){
        $result=FUser::loadPlaceByUser($idUser);
        return $result;
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

    public static function loadLogin($email,$password){
        $result=FUser::loadLogin($email,$password);
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

    public static function loadByCategory($idCategory){
        $result=FPlace::loadByCategory($idCategory);
        return $result;
    }

    public static function loadLowerCategory($idCategory){
        $result=FPlace::loadLowerCategory($idCategory);
        return $result;
    }

    public static function loadAllVisibleComment()
    {
        $result = FComment::loadAllVisibleComment();
        return $result;
    }

    public static function loadAllDeletedComment()
    {
        $result = FComment::loadAllDeletedComment();
        return $result;
    }

    public static function deleteComment($id){
        FComment::deleteComment($id);}

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

    public static function newUserToDB($IDuser, $email, $password, $name, $description, $IDimage, $username, $banned){
        FUser::newUserToDB( $email, $password, $name, $description, $IDimage, $username, $banned);
    }

    public static function newPost($idpost, $iduser, $autore, $titolo, $data, $deleted){
        FPost::newPost( $iduser, $titolo, $data, $deleted);
    }

    public static function reportPost($reportedPostId){
        FPost::loadReportedPost($reportedPostId);
    }
}