<?php


class CUser
{

    static function login2(){
        if(UServer::getMethod() =="GET"){
            if(static::isLogged()) {
                $pm = new FPersistentManager();
                $view = new VUser();
                $result = $pm->loadPostHomePage();
                $view->loginOk($result);
            }
            else{
                $view=new VUser();
                $view->showFormLogin();
            }
        }elseif (UServer::getMethod()=="POST")
            static::verifica();
    }

    /**
     * CONTROLLO SE HO GIA' UNA SESSIONE APERTA
        * SE LA SESSIONE E' APERTA E ATTIVA CONTROLLO SE HO GIA' SETTATO LO USERNAME,
        * CIOE' SE HO GIA'  FATTO L'ACCESSO
            * SE HO FATTO GIA' L'ACCESSO RIMANDO ALLA HOMEPAGE LOGGATO CON L'ARRAY DI POST DA MOSTRARE
            * ALTRIMENTI RIMANDO ALLA PAGINA DI LOGIN
        * SE LA SESSIONE E' ACCESA MA NON ATTIVA o E' SPENTA, LA ATTIVO E RIMANDO ALLA PAGINA DI LOGIN
     */
    static function login(){

        $view = new VUser();

        if (USession::getSessionStatus() == PHP_SESSION_ACTIVE){

            if (USession::getIsSet("userName")){

                $pm = new FPersistentManager();
                $result = $pm->loadPostHomePage();
                $view->loggedHome($result);

            } else{

                $view->loginForm();

            }
        } else{

            USession::getInstance();
            $view->loginForm();

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
        if (UCookie::getIsSet('PHPSESSID')) {
            if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                USession::getInstance();
            }
        }
        if (USession::getIsSet('utente')) {
            $logged = true;
        }
        return $logged;
    }

    private static function verifica(){
        $view = new VUtente();
        $pm = new FPersistentManager();
        $utente = $pm->loadLogin($_POST['email'], $_POST['password']);
        if ($utente != null && $utente->getState() != false) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $salvare = serialize($utente);
                $_SESSION['utente'] = $salvare;
                if ($_POST['email'] != 'admin@admin.com') {
                    if (isset($_COOKIE['chat']) && $_COOKIE['chat'] != $_POST['email']){
                        header('Location: /FillSpaceWEB/Messaggi/chat');
                    }
                    elseif (isset($_COOKIE['nome_visitato'])) {
                        header('Location: /FillSpaceWEB/Utente/dettaglioutente');
                    }
                    else {
                        if (isset($_COOKIE['chat']))
                            setcookie("chat", null, time() - 900,"/");
                        else
                            header('Location: /FillSpaceWEB/');
                    }
                }
                else {
                    header('Location: /FillSpaceWEB/Admin/homepage');
                }
            }
        }
        else {
            $view->loginError();
        }
    }
}