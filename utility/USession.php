<?php

/** la classe session serve per evitare la presenza all'interno del codice di tutti i riferimetni all'array superglobale
 *_SESSION.
 *Utilizza anche questa un singleton dell'istanza della variabile superglobale _SESSION alla quale si può accedere solo
 *attraverso i metodi dellaclasse USession
 */

class USession{

    private static $instance=null;




    public static function _instance()
    {
        // Start a session if not already started
        session_start();

        if ( false == isset( $_SESSION[ self::$_singleton_class ] ) )
        {
            $class = self::$_singleton_class;
            $_SESSION[ self::$_singleton_class ] = new $class;
        }

        return $_SESSION[ self::$_singleton_class ];
    }

    static function getInstance(){

        session_start();

        if (USession::$instance == null){
            if (isset($_SESSION['single'])) {
                USession::$instance = $_SESSION['single'];
            }
            else {
                USession::$instance = new USession();
                $_SESSION['single'] = USession::$instance;
            }
        }
        return USession::$instance;
    }

    /** RESTITUISCE LO STATO DELLA SESSIONE COME INTERO */
    function getSessionStatus(){
        return session_status();
    }

    /** AGGIUNGERE METODI DESTROY -  UNSET ECC... */
    function destroySession(){
        session_destroy();
    }

    /** fa l'unset di tutti gli elementi dell'array session */
    function unsetSession(){
        session_unset();
    }

    /** fa l'unset dell'elemento relativo passato in ingresso */
    static function unsetSessionElement($id){
        unset($_SESSION[$id]);
    }


    /** BISOGNA USARE QUESTA PER ACCEDERE AGLI ELEMENTI DI _SESSION */
    static function getElement($index){
        return $_SESSION[$index];
    }

    /** BISOGNA USARE QUESTA PER SCRIVERE ALL'INTERNO DI _SESSION */
    function setElement($index,$object){
        $_SESSION[$index]=$object;
    }

    /** RESTITUISCE UN BOOLEANO CHE INDICA SE UNA CHIAVE ($id) HA UN VALORE ASSOCIATO O NO */
    static function getIsSet($id){
        if (isset($_SESSION[$id])) {
            return true;
        }
        else {
            return  false;
        }
    }

}