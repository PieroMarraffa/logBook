<?php


class CAdmin
{


    static function isAdminLogged(){
        $identificato = false;
        if(USession::getIsSet('admin')){
                $identificato = true;
        }
        return $identificato;
    }

    /**
     * @throws SmartyException
     */
    static function adminHome(){
            $pm = FPersistentManager::getInstance();
            $view=new VAdmin();
            $image_reported=array();
            $image_banned=array();
            $array_banned=$pm->load("Banned",true,FUser::getClass());
            if(is_object($array_banned)){
                $array_b=array();
                $array_b[]=$array_banned;
            }else{
                $array_b=$array_banned;
            }
            $array_reported=$pm->load("Reported",true,FUser::getClass());
            if(is_object($array_reported)){
                $array_r=array();
                $array_r[]=$array_reported;
            }else{
                $array_r=$array_reported;
            }
            foreach ($array_r as $a){
                $id=$a->getImageID();
                $img=$pm->load("IDimage",$id,FImage::getClass());
                $image_reported[]=$img;
            }
            if(isset($array_b[0])){
            foreach ($array_b as $a){
                $id=$a->getImageID();
                $img=$pm->load("IDimage",$id,FImage::getClass());
                $image_banned[]=$img;
            }}else $array_b=array();
            $view->adminHomePage($array_b,$array_r,$image_reported,$image_banned);
    }

    static function adminLogout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function banUser($userID){

            $pm = FPersistentManager::getInstance();
            $pm->update("Reported",0,$userID,FUser::getClass());
            $resultPost=$pm->load("IDuser",$userID,FPost::getClass());
            if($resultPost!=null) {
                if (!is_array($resultPost)) {
                    $post = array();
                    $post[] = $resultPost;
                } else $post = $resultPost;
                foreach ($post as $p) {
                    $id = $p->getPostID();
                    $pm->update("Deleted", 1, $id, FPost::getClass());
                }
            }
            $resultComment=$pm->load("IDuser",$userID,FComment::getClass());
            if($resultComment!=null) {
                if (!is_array($resultComment)) {
                    $comment = array();
                    $comment[] = $resultComment;
                } else $comment = $resultComment;
                foreach ($comment as $c) {
                    $id = $c->getCommentID();
                    $pm->update("Deleted", 1, $id, FComment::getClass());
                }
            }
            $pm->update("Banned",1,$userID,FUser::getClass());
            header('Location: /logBook/Admin/adminHome');
    }

    /**
     * @throws SmartyException
     */
    static function ignoreUser($userID){

            $pm = FPersistentManager::getInstance();
            $pm->update("Reported", 0, $userID, FUser::getClass());
            header('Location: /logBook/Admin/adminHome');
    }

    static function restoreUser($userID){

            $pm = FPersistentManager::getInstance();
            $pm->update("Reported", 0, $userID, FUser::getClass());
            $resultPost = $pm->load("IDuser", $userID, FPost::getClass());
            if ($resultPost != null) {
                if (!is_array($resultPost)) {
                    $post = array();
                    $post[] = $resultPost;
                } else $post = $resultPost;
                foreach ($post as $p) {
                    $id = $p->getPostID();
                    $pm->update("Deleted", 0, $id, FPost::getClass());
                }
            }
            $resultComment = $pm->load("IDuser", $userID, FComment::getClass());
            if ($resultComment != null) {
                if (!is_array($resultComment)) {
                    $comment = array();
                    $comment[] = $resultComment;
                } else $comment = $resultComment;
                foreach ($comment as $c) {
                    $id = $c->getCommentID();
                    $pm->update("Deleted", 0, $id, FComment::getClass());
                }
            }
            $pm->update("Banned", 0, $userID, FUser::getClass());
            header('Location: /logBook/Admin/adminHome');
    }

    /**
     * @throws SmartyException
     */
    static function reportedComments(){

            $pm = FPersistentManager::getInstance();
            $view = new VAdmin;
            $reportedComment = $pm->loadAllDeletedComment();
            $author = array();
            foreach ($reportedComment as $a) {
                $author[] = $pm->load("IDuser", $a->getAuthorID(), FUser::getClass());
            }
            $image = array();
            foreach ($author as $a) {
                $img = $pm->load("IDimage", $a->getIDimage(), FImage::getClass());
                $image[] = $img;
            }
            $view->toReportedComments($reportedComment, $author, $image);

    }

    static function deleteComment($id){
        $pm=FPersistentManager::getInstance();
        $pm->deleteComment($id);
        $pm->deleteFromCommentReported($id);
        header('Location: /logBook/Admin/reportedComments');
    }

    static function ignoreComment($id){
        $pm=FPersistentManager::getInstance();
        $pm->deleteFromCommentReported($id);
        header('Location: /logBook/Admin/reportedComments');
    }




}