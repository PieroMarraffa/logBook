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

    static function adminHome(){
        $pm=new FPersistentManager();
        $view=new VAdmin();
        $array_banned=$pm->load("Banned",true,FUser::getClass());
        $array_reported=$pm->load("Reported",true,FUser::getClass());
        $view->adminHomePage($array_banned,$array_reported);
    }

    static function adminLogout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /logBook/User/login');
    }
    /**
     *
     */
    static function verificaCredenziali() {

        $session = new USession();
        $view = new VAdmin();
        $email = $session->getElement('email');
        $pw = $session->getElement('password');
        $logged = FPersistentManager::checkAdminCredentials($email, $pw);

        if ($logged){

           self::getReportedPost();

        }else{

            $view->loginForm();

        }
    }

    static function getReportedPost(){
        $view = new VAdmin();
        $reportedPosts = FPersistentManager::loadReportedPosts();
        $view->toAdminHomepage($reportedPosts);
    }

    static function deletePost(){
        $session = new USession();
        $postID = $session->getElement('IDpost');
        FPersistentManager::deletePost($postID);
        self::getReportedPost();
    }

    static function restorePost(){
        $session = new USession();
        $postID = $session->getElement('IDpost');
        FPersistentManager::restorePost($postID);
        self::getReportedPost();
    }

    static function getReportedComments(){
        $view = new VAdmin();
        $reportedComments = FPersistentManager::loadReportedComments();
        $view->toReportedComments($reportedComments);
    }

    static function deleteComment(){
        $session = new USession();
        $commentID = $session->getElement('IDcomment');
        FPersistentManager::deleteComment($commentID);
        self::getReportedComments();
    }

    static function restoreComment(){
        $session = new USession();
        $commentID = $session->getElement('IDcomment');
        FPersistentManager::restoreComment($commentID);
        self::getReportedComments();
    }

    static function getReportedUsers(){
        $view = new VAdmin();
        $reportedUsers = FPersistentManager::loadReportedUsers();
        $view->toReportedUsers($reportedUsers);
    }

    static function deleteUsers(){
        $session = new USession();
        $userID = $session->getElement('IDuser');
        FPersistentManager::deleteUser($userID);
        self::getReportedUsers();
    }

    static function restoreUser(){
        $session = new USession();
        $userID = $session->getElement('IDuser');
        FPersistentManager::restoreUser($userID);
        self::getReportedUsers();
    }
}