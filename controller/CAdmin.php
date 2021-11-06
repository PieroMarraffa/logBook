<?php


class CAdmin
{


    static function isAdminLogged(){
        $identificato = false;
        USession::getInstance();
        if(USession::getIsSet('admin')){
                $identificato = true;
        }
        return $identificato;
    }

    /**
     * @throws SmartyException
     */
    static function adminHome(){
        if(self::isAdminLogged()==true) {
            $pm = FPersistentManager::getInstance();
            $view = new VAdmin();
            $image_reported = array();
            $image_banned = array();
            $array_banned = $pm->load("Banned", true, FUser::getClass());
            if (is_object($array_banned)) {
                $array_b = array();
                $array_b[] = $array_banned;
            } else {
                $array_b = $array_banned;
            }
            $array_reported = $pm->load("Reported", true, FUser::getClass());
            if (is_object($array_reported)) {
                $array_r = array();
                $array_r[] = $array_reported;
            } else {
                $array_r = $array_reported;
            }
            foreach ($array_r as $a) {
                $id = $a->getImageID();
                $img = $pm->load("IDimage", $id, FImage::getClass());
                $image_reported[] = $img;
            }
            if (isset($array_b[0])) {
                foreach ($array_b as $a) {
                    $id = $a->getImageID();
                    $img = $pm->load("IDimage", $id, FImage::getClass());
                    $image_banned[] = $img;
                }
            } else $array_b = array();
            $view->adminHomePage($array_b, $array_r, $image_reported, $image_banned);
        }else header('Location: /logBook/User/home');

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
        if(self::isAdminLogged()==true) {
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
        }else header('Location: /logBook/User/home');
    }

    /**
     * @throws SmartyException
     */
    static function ignoreUser($userID){
        if(self::isAdminLogged()==true) {
            $pm = FPersistentManager::getInstance();
            $pm->update("Reported", 0, $userID, FUser::getClass());
            header('Location: /logBook/Admin/adminHome');
        }else header('Location: /logBook/User/home');
    }

    static function restoreUser($userID){
        if(self::isAdminLogged()==true) {
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
        }else header('Location: /logBook/User/home');
    }

    /**
     * @throws SmartyException
     */
    static function reportedComments(){
        if(self::isAdminLogged()==true) {
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
        }else header('Location: /logBook/User/home');
    }

    static function deleteComment($id){
        if(self::isAdminLogged()==true) {
            $pm=FPersistentManager::getInstance();
            $pm->deleteComment($id);
            $pm->deleteFromCommentReported($id);
            header('Location: /logBook/Admin/reportedComments');
        }else header('Location: /logBook/User/home');
    }

    static function ignoreComment($id){
        if(self::isAdminLogged()==true) {
            $pm=FPersistentManager::getInstance();
            $pm->deleteFromCommentReported($id);
            header('Location: /logBook/Admin/reportedComments');
        }else header('Location: /logBook/User/home');
    }


    /**
     * @throws SmartyException
     */
    static function reportedPosts(){
        if(self::isAdminLogged()==true) {
            $view = new VAdmin;
            $pm=FPersistentManager::getInstance();
            $result=$pm->loadAllDeletedPost();
            $image=array();
            if($result!=null) {
                foreach ($result as $r) {
                    $t = $pm->load("IDpost", $r->getPostID(), FTravel::getClass());
                    $i = $pm->load("IDtravel", $t->getTravelID(), FImage::getClass());
                    $image[] = $i;
                }
            }
            $view->toReportedPosts($result,$image);
        }else header('Location: /logBook/User/home');
    }

    static function deletePost($id){
        if(self::isAdminLogged()==true) {
            $pm=FPersistentManager::getInstance();
            $pm->deletePost($id);
            $pm->deleteFromPostReported($id);
            header('Location: /logBook/Admin/reportedPosts');
        }else header('Location: /logBook/User/home');
    }

    static function ignorePost($id){
        if(self::isAdminLogged()==true) {
            $pm=FPersistentManager::getInstance();
            $pm->deleteFromPostReported($id);
            header('Location: /logBook/Admin/reportedPosts');
        }else header('Location: /logBook/User/home');
    }

}