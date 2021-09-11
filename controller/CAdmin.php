<?php


class CAdmin
{
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
}