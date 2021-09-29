<?php


class VUser
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
    public function home($result){
        if(CUser::isLogged()){
            $this->smarty->assign('userlogged',"loggato");
            $u=USession::getElement('user');
            $user=unserialize($u);
            $adm = FPersistentManager::loadAdmin("Email", $user->getMail());
            if (isset($adm))
                header('Location: /logBook/Admin/adminHome');
            $this->smarty->assign('username',$user->getUserName());}
        else
            $this->smarty->assign('userlogged','nouser');

        $this->smarty->assign('array_post_home',$result);
        $this->smarty->display('home.tpl');}

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showFormLogin(){
        $this->smarty->display('login.tpl');
    }

    public function registration_form(){

        $this->smarty->display('registration.tpl');
    }

    public function detailPostLogged($id){
        $this->smarty->assign('IDpost', $id);
        $this->smarty->display('post_detail_logged.tpl');
    }

    public function detailPost($id){
        $this->smarty->assign('IDpost', $id);
        $this->smarty->display('post_detail.tpl');
    }

    /**
     * @throws SmartyException
     */
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
        $this->smarty->assign('array_post',$arrayPost);
        $this->smarty->display('profile.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError() {
        $this->smarty->assign('error',"errore");
        $this->smarty->display('login.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione della homepage dopo il login ( se è andato a buon fine)
     * @throws SmartyException
     */
    public function loginOk($array) {
        if(CUser::isLogged())
            $this->smarty->assign('userlogged',"loggato");
        $u=USession::getElement('user');
        $user=unserialize($u);
        $this->smarty->assign('username',$user->getUserName());
        $this->smarty->assign('array_post_home',$array);
        $this->smarty->display('home.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function registrationError ($error) {
        switch ($error) {
            case "email":
                $this->smarty->assign('errorEmail',"errore");
                break;
            case "typeimg" :
                $this->smarty->assign('errorType',"errore");
                break;
            case "size" :
                $this->smarty->assign('errorSize',"errore");
                break;
        }
        $this->smarty->display('registration.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changeCredentialForm($user, $image){
        if(isset($image[0])){
            $this->smarty->assign('type', $image[0]->getType());
            $this->smarty->assign('pic64', base64_encode($image[0]->getImageFile()));
        }
        else{
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/logBook/Smarty/immagini/user.png');
            $pic64= base64_decode($data);
            $type = "image/png";
            $this->smarty->assign('type', $type);
            $this->smarty->assign('pic64', $pic64);
        }
        //$this->smarty->assign('image',$image);
        $this->smarty->assign('user',$user);
        $this->smarty->assign('email',$user->getMail());
        $this->smarty->display('change_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changePassword(){
        $this->smarty->assign('change', 'password');
        $this->smarty->display('change_single_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changeEmail(){
        $this->smarty->assign('change', 'email');
        $this->smarty->display('change_single_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changeUsername(){
        $this->smarty->assign('change', 'username');
        $this->smarty->display('change_single_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changeImage(){
        $this->smarty->assign('change', 'image');
        $this->smarty->display('change_single_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function changeDescription(){
        $this->smarty->assign('change', 'description');
        $this->smarty->display('change_single_credential.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function updateError($error)
    {
        switch ($error) {
            case "email":
                $this->smarty->assign('errorEmail',"errore");
                break;
            case "typeimg" :
                $this->smarty->assign('errorType',"errore");
                break;
            case "size" :
                $this->smarty->assign('errorSize',"errore");
                break;
        }
        $this->smarty->display('changeImage.tpl');
    }
}