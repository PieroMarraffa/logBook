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
        $pm = FPersistentManager::getInstance();
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
    public function search_place($place,$array_post,$array_image){

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
        $typeImg=array();
        $pic64Img=array();
        foreach ($array_image as $im) {
            if($im!=null) {
                if(count($im)==1){
                    $typeImg[] = $im[0]->getType();
                    $pic64Img[] =  base64_encode($im[0]->getImageFile());}
                else{
                    $typeImg[] = $im[0]->getType();
                    $pic64Img[] =  $im[0]->getImageFile();
                }
            }
            else{
                $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/default_post.jpg');
                $pic64Img[]= base64_encode($data);
                $typeImg[] = "image/jpg";
            }
        }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);
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
    public function post($post,$author,$array_p,$array_image){
        $pm = FPersistentManager::getInstance();
        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
            $u=USession::getElement('user');
            $user=unserialize($u);
            $this->smarty->assign('username',$user->getUserName());
        }
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
        $typeImg=array();
        $pic64Img=array();
        if(count($array_image)==1) {
            foreach ($array_image as $im) {
                $typeImg[] = $im->getType();
                $pic64Img[] = base64_encode($im->getImageFile());
            }
        }
        else{
            foreach ($array_image as $im) {
                $typeImg[] = $im->getType();
                $pic64Img[] =$im->getImageFile();
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

        $this->smarty->assign('nDislike',$post->getNLike());
        $this->smarty->assign('nLike',$post->getNDisLike());
        $this->smarty->assign('post', $post);
        $this->smarty->assign('typeImg', $typeImg);
        $this->smarty->assign('pic64Img', $pic64Img);
        $this->smarty->assign('array_place', $array_p);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('Title',$post->getTitle());
        $this->smarty->assign('id',$author->getUserID());
        $this->smarty->assign('author',$author->getUserName());
        $this->smarty->assign('date',$post->getCreationDate());
        $this->smarty->assign('arrayExperience',$experience);
        $this->smarty->assign('arrayComment',$comment);
        $this->smarty->display('post_detail.tpl');

    }

    /**
     * @throws SmartyException
     */
    public function profileDetail($user, $image, $arrayPost,$arrayPlace,$array_image){
        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
            $u=USession::getElement('user');
            $utente=unserialize($u);
            $this->smarty->assign('username',$utente->getUserName());
        }
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
        $this->smarty->assign('array_place',$arrayPlace);
        $this->smarty->assign('user',$user);
        $this->smarty->assign('email',$user->getMail());
        if(!is_array($arrayPost)){
            $array_p=array();
            $array_p[]=$arrayPost;
        }else $array_p=$arrayPost;
        $typeImg=array();
        $pic64Img=array();
        if(count($array_image)!=0) {
            foreach ($array_image as $im) {
                if ($im != null) {
                    if (count($im) == 1) {
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] = base64_encode($im[0]->getImageFile());
                    } else {
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] = $im[0]->getImageFile();
                    }
                } else {
                    $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/default_post.jpg');
                    $pic64Img[] = base64_encode($data);
                    $typeImg[] = "image/jpg";
                }
            }
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/default_post.jpg');
            $pic64Img[] = base64_encode($data);
            $typeImg[] = "image/jpg";
        }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);
        $this->smarty->assign('postList',$array_p);
        $this->smarty->display('profile_user.tpl');
    }
}