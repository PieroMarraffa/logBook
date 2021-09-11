<?php


class CUser
{

    /**QUESTA E' LA FUNZIONE CHE RIMANDA ALLA FORM DI LOGIN
     * CONTROLLO SE HO GIA' UNA SESSIONE APERTA
        * SE LA SESSIONE E' APERTA E ATTIVA CONTROLLO SE HO GIA' SETTATO LO USERNAME,
        * CIOE' SE HO GIA'  FATTO L'ACCESSO
            * SE HO FATTO GIA' L'ACCESSO RIMANDO ALLA HOMEPAGE LOGGATO CON L'ARRAY DI POST DA MOSTRARE
            * ALTRIMENTI RIMANDO ALLA PAGINA DI LOGIN
        * SE LA SESSIONE E' ACCESA MA NON ATTIVA o E' SPENTA, LA ATTIVO E RIMANDO ALLA PAGINA DI LOGIN
     */
    static function login(){

        $view = new VUser();
        $session = new USession();
        $logged = $session->getElement("logged");

        if ($logged){

            $result = FPersistentManager::loadPostHomePage();
            $view->loggedHome($result, "username");

        } else{

            $view->loginForm();

        }

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

            $view->loggedHome();

        }

    }


    static function clickedPost(){

        $view = new VUser();
        $session = new USession();
        $id = $session->getElement("IDpost");


    }
}