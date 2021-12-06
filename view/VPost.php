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

    /**
     * @throws SmartyException
     */
    public function savePost($c){
        $this->smarty->display('home.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function create_post($creaPost, $postID){
        $this->smarty->assign('creaPost', $creaPost);
        $this->smarty->assign('postID', $postID);
        $this->smarty->display('create_post.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function modify_post($post, $arrayExp, $numero, $postID, $image, $creaPost){
        $typeImg=array();
        $pic64Img=array();
        if(count($image)==1) {
            foreach ($image as $im) {
                $typeImg[] = $im->getType();
                $pic64Img[] = $im->getImageFile();
            }
        }
        else{
            foreach ($image as $im) {
                $typeImg[] = $im->getType();
                $pic64Img[] =$im->getImageFile();
            }
        }
        $this->smarty->assign('image', $image);
        $this->smarty->assign('typeImg', $typeImg);
        $this->smarty->assign('pic64Img', $pic64Img);
        $this->smarty->assign('Title', $post->getTitle());
        $this->smarty->assign('array_experience', $arrayExp);
        $this->smarty->assign('numero', $numero);
        $this->smarty->assign('postID', $postID);
        $this->smarty->assign('creaPost', $creaPost);
        $this->smarty->display('create_post.tpl');
    }
}

