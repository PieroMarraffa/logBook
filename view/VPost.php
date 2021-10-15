<?php


class VPost
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

    public function savePost($c){
        $this->smarty->display('home.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function create_post(){
        //$this->smarty->assign('creatorID', $creatorId);
        //$this->smarty->assign('creatoUsername',$creatorUsername);
        $this->smarty->display('create_post.tpl');
    }
}