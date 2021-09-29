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

    public function salvaPost($title, $img, $description){
        $this->smarty->assign('title', $title);
        $this->smarty->assign('image', $img);
        $this->smarty->assign('description', $description);
        $this->smarty->display('home_logged.tpl');
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