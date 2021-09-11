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
        $session = new USession();
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
}