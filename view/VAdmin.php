<?php



class VAdmin
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


    public function toAdminHomepage(){
        $this->smarty->display('admin_reported_posts.tpl');
    }

    public function loginForm(){
        $this->smarty->display('login.tpl');
    }
}