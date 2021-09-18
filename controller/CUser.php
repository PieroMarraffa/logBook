<?php

require 'utility/UCookie.php';
require 'utility/USession.php';
require 'utility/UServer.php';

class CUser
{

    static function login (){
        //se nell'url viene immesso il pattern /User/login
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(static::isLogged()) {
                $pm = new FPersistentManager();
                $view = new VUser();
                $result = $pm->loadPostHomePage();//Carica i post che devono stare nella schermata di home
                $view->loginOk($result);
            }
            else{
                $view=new VUser();
                $view->showFormLogin();
            }
        }
        //se viene richiamato il metodo login attraverso una richiesta POST
        //Vuol dire che si sta cercando di accedere all'account premendo sul pulsante di login dopo aver inserito le credenziali
        elseif ($_SERVER['REQUEST_METHOD']=="POST")
            static::checkLogin();
    }


    /**
     * @throws SmartyException
     */
    static function checkLogin(){
        $view = new VUser();
        $pm = new FPersistentManager();
        $exist = $pm->loadLogin($_POST['email'], $_POST['password']);
        $admin=$pm->loadAdmin("IDadmin",1);
        $adminEmail=$admin->getMail();
        $adminPassword=$admin->getPassword();
        if($exist==true){
            $user=$pm->load("Email",$_POST['email'],"FUser");
        if ($user != null && $user->getDelete() != true) {
            if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                USession::getInstance();
                $salvare = serialize($user);
                USession::setElement('user',$salvare);

                if (isset($_COOKIE['']) && $_COOKIE[''] != $_POST['email']){
                                                            //Se vogliamo mettere dei cookie vanno qui
                }
                else {
                        header('Location: /logBook/');
                }

            }
        }
        }
        elseif ($adminEmail==$_POST['email']&& $adminPassword==$_POST['password']){
            if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                USession::getInstance();
                $salvare = serialize($admin);
                USession::setElement('user',$salvare);
                if(isset($_COOKIE[''])){
                                                                //Se vogliamo mettere dei cookie vanno qui
                }
                else
                header('Location: /FillSpaceWEB/Admin/homepage');
            }

        }
        else {
            $view->loginError();
        }
    }


    /**
     * @throws SmartyException
     */
    static function profile(){
        $view = new VUser();
        $pm = new FPersistentManager();
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                USession::getInstance();
                $user=unserialize(USession::getElement('user'));
                $img=$pm->load("IDimage",$user->getImageID(),'FImage');
                $arrayPost=$pm->load("IDuser",$user->getUserID(),"FPost");
                $view->profile($user,$img,$arrayPost);
                }
            } else
                header('Location: /logBook/User/login');
        }



//----------------------------DA RIVEDERE----------------------------------


    /**QUESTA E' LA FUNZIONE CHE RIMANDA ALLA FORM DI LOGIN
     * CONTROLLO SE HO GIA' UNA SESSIONE APERTA
        * SE LA SESSIONE E' APERTA E ATTIVA CONTROLLO SE HO GIA' SETTATO LO USERNAME,
        * CIOE' SE HO GIA'  FATTO L'ACCESSO
            * SE HO FATTO GIA' L'ACCESSO RIMANDO ALLA HOMEPAGE LOGGATO CON L'ARRAY DI POST DA MOSTRARE
            * ALTRIMENTI RIMANDO ALLA PAGINA DI LOGIN
        * SE LA SESSIONE E' ACCESA MA NON ATTIVA o E' SPENTA, LA ATTIVO E RIMANDO ALLA PAGINA DI LOGIN
     */
    static function login2(){

        $view = new VUser();
        $session = USession()::_instance();
        $logged = $session->getElement("logged");

        if ($logged){

            $result = FPersistentManager::loadPostHomePage();
            $view->loggedHome($result, "username");

        } else{

            $view->loginForm();

        }

    }

    /**
     * Metodo che verifica se l'utente è loggato
     */
    static function isLogged() {
        $identificato = false;
        if (UCookie::getIsSet('PHPSESSID')) {
            if (session_status() == PHP_SESSION_NONE) {
                //header('Cache-Control: no cache'); //no cache
                //session_cache_limiter('private_no_expire'); // works
                //session_cache_limiter('public'); // works too
                USession::getInstance();
            }
        }
        if (USession::getIsSet('utente')) {
            $identificato = true;
        }
        return $identificato;
    }


    /** QUESTA FUNZIONE VERIFICA SE LE CREDENZIALI IMMESSE NELLA FORM DI LOGIN CORRISPONDONO A QUELLE DI UN UTENTE ESISTENTE.
     *  VIENE RICHIAMATA DAL BOTTONE DI LOG IN QUINDI HO LA CERTEZZA CHE UNA SESSIONE E' GIA' APERTA.
     *  LA FUNZIONE RICHIAMA LA FUNZIONE DI FDataBase IN CUI SI PRELEVA L'UTENTE CON MAIL E PASSWORD ASSEGNATI
    * SE L'UTENTE RISULTA ESISTENTE VIENE REINDIRIZZATO ALLA HOME LOGGED
    * ALTRIMENTI VIENE RIMANDATO ALLA FORM DI LOGIN
    */
    static function verificaCredenziali(){

        $view = new VUser();
        $logged = FPersistentManager::checkUserCredentials("email", "password");

        if ($logged){

            $result = FPersistentManager::loadPostHomePage();
            $view->loggedHome($result, "username");

        } else{

            $view->loginForm();

        }
    }


    /** QUESTA E' LA FUNZIONE CHE RIMANDA ALLA FORM DI SIGNUP
     * CONTROLLA CHE NON SIA RICHIAMATA DA UN UTENTE GIA' LOGGATO
     * RIMANDA ALLA FORM DI REGISTRAZIONE
     */
    static function registrazione(){

        $view = new VUser();
        $session = new USession();
        $logged = $session->getElement("logged");

        if ($logged){

            $result = FPersistentManager::loadPostHomePage();
            $view->loggedHome($result, "username");

        } else{

            $view->signupForm();

        }
    }

    /** QUESTA E' LA FUNZIONE CHE VERIFICA SE LE CREDENZIALI INSERITE NELLA REGISTRAZIONE APPARTENGONO GIA' AD UN ALTRO USER
     * CONTROLLA CHE NON SIA RICHIAMATA DA UN UTENTE GIA' ESISTENTE
     * RIMANDA ALLA HOME PAGE LOGGED
     */
    static function accountEsistente(){

        $view = new VUser();
        $session = new USession();
        $email = $session->getElement("email");

        if (FPersistentManager::checkExistingUser($email)){

            $view->loginForm();

        } else{

            $IDuser = $session->getElement("IDuser");
            $email = $session->getElement("email");
            $password = $session->getElement("password");
            $name = $session->getElement("name");
            $description = $session->getElement("description");
            $image = $session->getElement("image");
            $username = $session->getElement("username");
            $banned = $session->getElement("banned");

            FPersistentManager::newUserToDB($IDuser, $email, $password, $name, $description, $image, $username, $banned);
            $view->loggedHome();

        }

    }

    /** QUESTA E' LA FUNZIONE CHE CARICA LA PAGINA DI DETTAGLIO DEL POST CLICCATO SULLA HOME PAGE
     */
    static function clickedPost(){

        $view = new VUser();
        $session = new USession();

        if ($session->getElement('logged')){

            $id = $session->getElement("IDpost");
            $view->detailPostLogged($id);

        } else{

            $id = $session->getElement("IDpost");
            $view->detailPost($id);

        }
    }
}