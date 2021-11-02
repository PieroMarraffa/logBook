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
    public function create_post($arrayPlace){
        $this->smarty->assign('arrayPlace', $arrayPlace);
        $this->smarty->display('create_post.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function modify_post($travel, $arrayExp, $numero, $arrayPlace, $postID){
        $this->smarty->assign('travelTitle', $travel->getTitle());
        $this->smarty->assign('array_experience', $arrayExp);
        $this->smarty->assign('numero', $numero);
        $this->smarty->assign('arrayPlace', $arrayPlace);
        $this->smarty->assign('postID', $postID);
        $this->smarty->display('update_post.tpl');
    }
}

