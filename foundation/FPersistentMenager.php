<?php


class FPersistentMenager
{
/** forse rimuovere il supreme admin dalle classi che supportano la store */
    public static function store($object){
        $Eclass=get_class($object);
        $Fclass=$Eclass;
        $Fclass[0]="F";
        $Fclass::store($object);
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

    public static function load($field, $val,$Fclass) {
        $ris = null;
        $ris = $Fclass::loadByField($field,$val);
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

    public static function loadExperienceByFather($id){
        $result=null;
        $result=FExperience::loadExperienceChild($id);
        return $result;
    }

    public static function loadExperienceByPost($idPost){
        $result=null;
        $result=FExperience::loadByPost($idPost);
        return $result;
    }

    public static function loadByNation($nation){
        $result=null;
        $result=FPlace::loadByNation($nation);
        return $result;
    }

    public static function loadAdmin(){
        $result=FUser::loadAdmin();
        return $result;
    }

    public static function isAdmin($id){
        $result=FUser::isAdmin($id);
        return $result;
    }

    public static function loadPlaceByExperience($idExperience){
        $result=FExperience::loadPlaceByExperience($idExperience);
        return $result;
    }

    public static function storePlaceToExperience($idExperience,$idPLace){
        $result=FExperience::storePlaceToExperience($idExperience,$idPLace);
        return $result;
    }


    public static function loadExperienceByPlace($id){
        $result= FPlace::loadExperienceByPlace($id);
        return $result;
    }

    public static function loadPostByPlace($id){
        $result = FPlace::loadPostByPlace($id);
        return $result;
    }

    public static function loadUserByPlace($id){
        $result =FPlace::loadUserByPlace($id);
        return $result;
    }

    public static function storePlaceToPost($idPost,$idPlace){
        $result=FPost::storePlaceToPost($idPost,$idPlace);
        return $result;
    }

    public static function storePlaceToUser($idUser,$idPlace){
        $result=FUser::storePlaceToUser($idUser,$idPlace);
        return $result;
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
        $result=FUser::loadCommentReportedByUser($idUser);
        return $result;

    }

    public static function loadPostReportedByUser($idUser){
        $result=FUser::loadPostReportedByUser($idUser);
        return $result;
    }

    public static function storeCommentReporter($idUser,$idComment){
        $result=FUser::storeCommentReporter($idUser,$idComment);
        return $result;
    }

    public static function storePostReporter($idUser,$idPost){
        $result=FUser::storePostReporter($idUser,$idPost);
        return $result;
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
        FPost::deletePost($id);}

    public static function restorePost($id){
        FPost::restorePost($id);}
}