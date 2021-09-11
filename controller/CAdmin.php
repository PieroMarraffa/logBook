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

            $view->toAdminHomepage();

        }else{

            $view->loginForm();

        }
    }

    static function deletePost(){
        $session = new USession();
        $view = new VAdmin();
        $postID = $session->getElement('IDpost');
        
    }
}