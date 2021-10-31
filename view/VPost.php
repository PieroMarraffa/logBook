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

    public function profile($user, $image, $arrayPost,$arrayPlace){
        if(isset($image[0])){
            $this->smarty->assign('type', $image[0]->getType());
            $this->smarty->assign('pic64', base64_encode($image[0]->getImageFile()));}
        else{
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
            $pic64= base64_encode($data);
            $type = "image/png";
            $this->smarty->assign('type', $type);
            $this->smarty->assign('pic64', $pic64);
        }
        //$this->smarty->assign('image',$image);
        $this->smarty->assign('array_place',$arrayPlace);
        $this->smarty->assign('user',$user);
        $this->smarty->assign('email',$user->getMail());
        $this->smarty->assign('postList',$arrayPost);
        $this->smarty->display('profile.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function modify_post($travel, $arrayExp, $numero, $arrayPlace){
        $this->smarty->assign('travelTitle', $travel->getTitle());
        $this->smarty->assign('array_experience', $arrayExp);
        $this->smarty->assign('numero', $numero);
        $this->smarty->assign('arrayPlace', $arrayPlace);
        $this->smarty->display('update_post.tpl');
    }
}

