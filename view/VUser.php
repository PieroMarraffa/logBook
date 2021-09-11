<?php


class VUser
{
    /**
     * @var Smarty
     */
    private $smarty;

    /**
     * Funzione che inizializza e configura smarty.
     */
    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    /**
     * Funzione che reindirizza alla home da loggati.
     */
    public function loggedHome($array, $username){
        $this->smarty->assign('array', $array);
        $this->smarty->assign('username', $username);
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     */
    public function loginForm(){
        $this->smarty->display('login.tpl');
    }
}