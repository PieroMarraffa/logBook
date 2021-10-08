<?php


class VResearch
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
     * @throws SmartyException
     */
    public function search_user($array_user,$post){
        if(CUser::isLogged()){
          $this->smarty->assign('userlogged',"loggato");
        $u=USession::getElement('user');
        $user=unserialize($u);
        $this->smarty->assign('username',$user->getUserName());}
        if(!is_array($array_user)){
            $array_u=array();
            $array_u[]=$array_user;
        }else $array_u=$array_user;
        if(is_object($post)){
            $array_p=array();
            $array_p[]=$post;
        }elseif(is_array($post)) $array_p=$post;
        else $array_p=null;
        $this->smarty->assign('arrayUser',$array_u);
        $this->smarty->assign('post',$array_p);
        $this->smarty->display('list_post_user.tpl');
    }


    /**
     * @throws SmartyException
     */
    public function search_place($place,$array_post){

        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
        $u=USession::getElement('user');
        $user=unserialize($u);
        $this->smarty->assign('username',$user->getUserName());}
        $this->smarty->assign('arrayPostPlace',$place);
        $this->smarty->assign('TitlePlace',$place->getName());
        $this->smarty->assign('Category',$place->getCategory());
        if(is_object($array_post)){
            $array_p=array();
            $array_p[]=$array_post;
        }
        elseif(is_array($array_post)) $array_p=$array_post;
        else $array_p=null;
        $this->smarty->assign('arrayPostPlace',$array_p);
        $this->smarty->display('list_post_place.tpl');
    }

}