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
    public function modify_post($travel){
        $num = 2;
        $this->smarty->assign('title', $travel->getExperienceList()[0]->getTitle());
        echo $travel->getExperienceList()[0]->getTitle();
        $this->smarty->assign('description', $travel->getExperienceList()[0]->getDescription());
        $this->smarty->assign('startDay', $travel->getExperienceList()[0]->getStartDay());
        $this->smarty->assign('endDay',$travel->getExperienceList()[0]->getEndDay());
        $this->smarty->assign('numero', $num);
        $this->smarty->assign('travelTitle', $travel->getTitle());
        $this->smarty->display('update_post.tpl');
    }

    public function prova($travel, $num){
        foreach ($travel->getExperienceList() as $exp){
            echo "     A STECCA      ";
            echo var_dump($exp);
            echo "     A STECCA      ";
            $this->smarty->assign('experience', $exp);
            $this->smarty->assign('numero', $num);
        }
    }
}

