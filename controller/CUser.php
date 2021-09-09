<?php


class CUser
{

    static function login(){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(static::isLogged()) {
                $pm = new FPersistentManager();
                $view = new VUser();
                self::homepage();
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
        $pm = new FPersistentManager();
        $allPosts = array();
        $allLikes = array();
        $mostLikedPost = array();

        $allPosts->addAll($pm->loadAllPost());
        $allLikes = $pm->loadAllLikes();
        if ($pm->etPostCount() > 0){
            $mostLikedPost[0]= $allPosts[0];
            if ($pm->etPostCount() > 1){
                $mostLikedPost[1]= $allPosts[1];
                if ($pm->etPostCount() > 2){
                    $mostLikedPost[2]= $allPosts[2];
                    if ($pm->etPostCount() > 3){
                        $mostLikedPost[3]= $allPosts[3];
                        if ($pm->etPostCount() > 4){
                            for($i = 4; $i < $allPosts->size(); $i++){

                            }
                        }
                    }
                }
            }
        }
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