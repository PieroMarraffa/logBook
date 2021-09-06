<?php

/** la classe session serve per evitare la presenza all'interno del codice di tutti i riferimetni all'array superglobale
 *_SESSION.
 *Utilizza anche questa un singleton dell'istanza della variabile superglobale _SESSION alla quale si può accedere solo
 *attraverso i metodi dellaclasse USession
 */

class USession{

    private static $instance=null;


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


    /** BISOGNA USARE QUESTA PER ACCEDERE AGLI ELEMENTI DI _SESSION */
    private static function getElement($index){
        return $_SESSION[$index];
    }

    /** BISOGNA USARE QUESTA PER SCRIVERE ALL'INTERNO DI _SESSION */
    public static function setElement($index,$object){
        $_SESSION[$index]=$object;
    }

}