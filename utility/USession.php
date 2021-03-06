<?php

/** la classe session serve per evitare la presenza all'interno del codice di tutti i riferimetni all'array superglobale
 *_SESSION.
 *Utilizza anche questa un singleton dell'istanza della variabile superglobale _SESSION alla quale si può accedere solo
 *attraverso i metodi dellaclasse USession
 */

class USession{

    private static $instance=null;

    static function getInstance(){

        if (USession::$instance == null){
            if (isset($_SESSION['single'])) {
                USession::$instance = $_SESSION['single'];
            }
            else {
                session_start();
                USession::$instance = new USession();
                $_SESSION['single'] = USession::$instance;
            }
        }
        return USession::$instance;
    }

    /** RESTITUISCE LO STATO DELLA SESSIONE COME INTERO */
    static function getSessionStatus(){
        return session_status();
    }

    /** AGGIUNGERE METODI DESTROY -  UNSET ECC... */
    static function destroySession(){
        session_destroy();
    }

    /** fa l'unset di tutti gli elementi dell'array session */
    static function unsetSession(){
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
    static function setElement($index,$object){
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