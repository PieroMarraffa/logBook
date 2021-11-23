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
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass=="FComment" || $Fclass=="FImage" || $Fclass=="FLike" || $Fclass=="FPost" || $Fclass=="FUser"  || $Fclass=="FTravel")//AGGIUNGI LE FOUNDATION MAN MANO
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



    public static function update($field, $newvalue, $val,$Fclass) {
        $ris = null;
        if ($Fclass == "FExperience" || $Fclass == "FPlace" || $Fclass=="FComment" || $Fclass=="FImage" || $Fclass=="FLike" || $Fclass=="FPost" || $Fclass=="FUser" || $Fclass=="FTravel")//AGGIUNGI LE FOUNDATION MAN MANO
            $ris = $Fclass::update($field, $newvalue, $val);
        else
            echo "METODO NON SUPPORTATO DALLA CLASSE";
        return $ris;
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



    public static function loadPlaceProssimity($lat, $lng, $prossimity){
        $result= FPlace::loadPlaceProssimit($lat, $lng, $prossimity);
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


    public static function deleteFromCommentReported($idComment){
        FComment::deleteFromCommentReported($idComment);
    }

    public static function deleteFromPostReported($idPost){
        FPost::deleteFromPostReported($idPost);
    }

    public static function deleteFromReaction($idPost){
        FPost::deleteFromReaction($idPost);
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


    public static function loadPostByPlaceCountryName($cn){
        $place = self::load('CountryName', $cn, FPlace::getClass());
        if (is_array($place)) {
            foreach ($place as $p){
                $result = self::load('IDplace',$p->getPlaceID(), FExperience::getClass());
                if (is_array($result)){
                    foreach ($result as $r){
                        $experience[] = $r;
                    }
                } else{
                    $experience[] = $result;
                }
            }
            if (is_array($experience)){
                foreach ($experience as $e){
                    $post[] = self::loadPostByExperience($e);
                }
                if (is_array($post)){
                    $pf[] = $post[0];
                    foreach ($post as $p){
                        $assignable = true;
                        foreach ($pf as $f){
                            if ($p->getPostID() == $f->getPostID()){
                                $assignable = false;
                            }
                        }
                        if ($assignable == true){
                            $pf[] = $p;
                        }
                    }
                    return $pf;
                } else{
                    return $post;
                }
            } else{
                if ($experience != NULL) {
                    $post = self::loadPostByExperience($experience[0]);
                    if ($post != NULL){
                        return $post;
                    }
                }
            }
        } else{
            if ($place != NULL){
                $experience = self::loadExperienceByPlaceID($place->getPlaceID());
                if (is_array($experience)){
                    foreach ($experience as $e){
                        $post[] = self::loadPostByExperience($e);
                    }
                    if (is_array($post)){
                        $pf[] = $post[0];
                        foreach ($post as $p){
                            $assignable = true;
                            foreach ($pf as $f){
                                if ($p->getPostID() == $f->getPostID()){
                                    $assignable = false;
                                }
                            }
                            if ($assignable == true){
                                $pf[] = $p;
                            }
                        }
                        return $pf;
                    } else{
                        return $post;
                    }
                } else{
                    if ($experience != NULL) {
                        $post = self::loadPostByExperience($experience[0]);
                        if ($post != NULL){
                            return $post;
                        }
                    }
                }
            }
        }
    }


    public static function loadPostByProssimity($lat, $lng, $prossimity){
        $place = self::loadPlaceProssimity($lat, $lng, $prossimity);
        if (is_array($place)) {
            foreach ($place as $p){
                $result = self::load('IDplace',$p->getPlaceID(), FExperience::getClass());
                if (is_array($result)){
                    foreach ($result as $r){
                        $experience[] = $r;
                    }
                } else{
                    $experience[] = $result;
                }
            }
            if (is_array($experience)){
                foreach ($experience as $e){
                    $post[] = self::loadPostByExperience($e);
                }
                    if (is_array($post)){
                        $pf[] = $post[0];
                        foreach ($post as $p){
                            $assignable = true;
                            foreach ($pf as $f){
                                if ($p->getPostID() == $f->getPostID()){
                                    $assignable = false;
                                }
                            }
                            if ($assignable == true){
                                $pf[] = $p;
                            }
                        }
                        return $pf;
                    } else{
                        return $post;
                    }
            } else{
                if ($experience != NULL) {
                    $post = self::loadPostByExperience($experience[0]);
                    if ($post != NULL){
                        return $post;
                    }
                }
            }
        } else{
            if ($place != NULL){
                $experience = self::loadExperienceByPlaceID($place->getPlaceID());
                if (is_array($experience)){
                    foreach ($experience as $e){
                        $post[] = self::loadPostByExperience($e);
                    }
                    if(isset($post)) {
                        if (is_array($post)) {
                            $pf[] = $post[0];
                            foreach ($post as $p) {
                                $assignable = true;
                                foreach ($pf as $f) {
                                    if ($p->getPostID() == $f->getPostID()) {
                                        $assignable = false;
                                    }
                                }
                                if ($assignable == true) {
                                    $pf[] = $p;
                                }
                            }
                            return $pf;
                        } else {
                            return $post;
                        }
                    }
                } else{
                    if ($experience != NULL) {
                        $post = self::loadPostByExperience($experience[0]);
                        if ($post != NULL){
                            return $post;
                        }
                    }
                }
            }
        }
        return NULL;
    }


    public static function loadExperienceByPlaceID($id){
        $experience=self::load('IDplace',$id, FExperience::getClass());
        return $experience;
    }


    public static function loadPostByExperience(EExperience $ex){
        $post = self::load('IDpost',$ex->getPostID(), FPost::getClass());
        return $post;
    }

}