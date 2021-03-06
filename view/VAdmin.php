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

    /**
     * @throws SmartyException
     */
    public function adminHomepage( $array_banned,$array_reported,$image_reported,$image_banned){
        $typeR=array();
        $pic64R=array();
        $typeB=array();
        $pic64B=array();
        foreach($image_reported as $img){
            if(isset($img)){
                $typeR[]=$img->getType();
                $pic64R[]=base64_encode($img->getImageFile());
            }else{
                $data = file_get_contents( './Smarty/immagini/user.png');
                $pic64R[]= base64_encode($data);
                $typeR[]= "image/png";
            }
        }
        $this->smarty->assign('typeR', $typeR);
        $this->smarty->assign('pic64R', $pic64R);

        foreach($image_banned as $img){
            if($img!=null){
                $typeB[]=$img->getType();
                $pic64B[]=base64_encode($img->getImageFile());
            }else{
                $data = file_get_contents( './Smarty/immagini/user.png');
                $pic64B[]= base64_encode($data);
                $typeB[]= "image/png";
            }
        }
        $this->smarty->assign('typeB', $typeB);
        $this->smarty->assign('pic64B', $pic64B);
        $this->smarty->assign('userReported', $array_reported);
        $this->smarty->assign('userBanned', $array_banned);
        $this->smarty->display('admin_reported_user.tpl');
    }

    /**
     * Funzione di supporto che si occupa gestire le immgini degli utenti presenti nell'elenco delle recensioni
     * @param $imgrec
     * @return array $type array dei MIME type delle immagini, $pic64 array dei dati delle immagini
     */
    public function SetImageRecensione ($imgrec) {
        $type = null;
        $pic64 = null;
        if (is_array($imgrec)) {
            foreach ($imgrec as $item) {
                if (isset($item[0])) {
                    $pic64[] = base64_encode($item[0]->getImageFile());
                    $type[] = $item[0]->getType();
                } else {
                    $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
                    $pic64[] = base64_encode($data);
                    $type[] = "image/png";
                }
            }
        }
        elseif (isset($imgrec)) {
            $pic64 = base64_encode($imgrec->getData());
            $type = $imgrec->getType();
        }
        return array($type, $pic64);
    }

    /**
     * @throws SmartyException
     */
    public function loginForm(){
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function toReportedComments($array,$author,$image){
        $typeImg=array();
        $pic64Img=array();
        foreach ($image as $im) {
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
                $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
                $pic64Img[]= base64_encode($data);
                $typeImg[] = "image/png";
            }
        }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);
        $this->smarty->assign('commentArrayReported', $array);
        $this->smarty->assign('author', $author);
        $this->smarty->display('admin_reported_comment.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function toReportedUsers($array){
        $this->smarty->assign('reportedComments', $array);
        $this->smarty->display('admin_reported_user.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function toReportedPosts($arrayReportedPost,$image){
        $typeImg=array();
        $pic64Img=array();
        foreach ($image as $im) {
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
        $this->smarty->assign('arrayReportedPost', $arrayReportedPost);
        $this->smarty->display('admin_reported_post.tpl');
    }
}