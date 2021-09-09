<?php


class CUser
{

    static function login(){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(static::isLogged()) {
                $pm = new FPersistentManager();
                $view = new VUser();
                $result = $pm->loadAll();
                $view->loginOk($result);
            }
            else{
                $view=new VUtente();
                $view->showFormLogin();
            }
        }elseif ($_SERVER['REQUEST_METHOD']=="POST")
            static::verifica();
    }


    public function homepage(){
        
    }


    /** Ogni volta che bisogn accedere ad un'area in cui bisogna essere loggati si richiama questa funzione
     *Se l'utente è loggato
     *Se non è loggato si viene rimandati alla schermata di login
     */
        static function logged(){

        }

    /**
     * Metodo che verifica se l'utente è loggato
     */
    static function isLogged() {
        $logged = false;
        if (isset($_COOKIE['PHPSESSID'])) {
            if (session_status() == PHP_SESSION_NONE) {
                //header('Cache-Control: no cache'); //no cache
                //session_cache_limiter('private_no_expire'); // works
                //session_cache_limiter('public'); // works too
                session_start();
            }
        }
        if (isset($_SESSION['utente'])) {
            $logged = true;
        }
        return $logged;
    }
}