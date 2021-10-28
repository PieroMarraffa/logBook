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
        $pm = new FPersistentManager();
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
        $type=array();
        $pic64=array();
        $img=array();
        foreach($array_u as $u){
            $img[]=$pm->load("IDimage",$u->getImageID(),'FImage');
        }
        foreach($img as $i){
            if(isset($i[0])){
                $type[]=$i[0]->getType();
                $pic64[]=base64_encode($i[0]->getImageFile());}
            else{
                $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
                $pic64[]= base64_encode($data);
                $type[]= "image/png";
            }
        }
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
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
        $this->smarty->assign('Place',$place);
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

    /**
     * @throws SmartyException
     */
    public function search_error($research){
        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
            $u=USession::getElement('user');
            $user=unserialize($u);
            $this->smarty->assign('username',$user->getUserName());}
        $this->smarty->assign('research',$research);
        $this->smarty->display('error.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function post($post, $author,$array_p){
        $pm = new FPersistentManager();
        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
            $u=USession::getElement('user');
            $user=unserialize($u);
            $this->smarty->assign('username',$user->getUserName());}
        $travel = $post->getTravel();
        $experience=$travel->getExperienceList();
        $array_c=$post->getCommentList();
        $like=$post->getLikeList();
        $type=array();
        $pic64=array();
        $img=array();
        if(!is_array($array_c)){
            $comment=array();
            $comment[]=$array_c;
        }else $comment=$array_c;
        foreach($comment as $u){
            if($u!=null) {
                $img[] = $pm->load("IDimage", $u->getAuthor()->getImageID(), 'FImage');
            }
        }
        foreach($img as $i){
            if(isset($i[0])){
                $type[]=$i[0]->getType();
                $pic64[]=base64_encode($i[0]->getImageFile());}
            else{
                $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
                $pic64[]= base64_encode($data);
                $type[]= "image/png";
            }
        }
        $this->smarty->assign('array_place', $array_p);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('Title',$post->getTitle());
        $this->smarty->assign('author',$author->getUserName());
        $this->smarty->assign('date',$post->getCreationDate());
        $this->smarty->assign('arrayExperience',$experience);
        $this->smarty->assign('arrayComment',$comment);
        $this->smarty->display('post_detail.tpl');

    }
}