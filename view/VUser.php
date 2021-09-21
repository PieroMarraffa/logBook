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
     * Funzione che reindirizza alla home da loggati.
     */
    public function loggedHome($array, $username){
        $this->smarty->assign('array', $array);
        $this->smarty->assign('username', $username);
        $this->smarty->display('home_logged.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
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
    public function profile($user, $image, $arrayPost){
        $this->smarty->assign();                                /** VEDI COME GESTIRE LE IMMAGINI */
        $this->smarty->assign('username',$user->getUserName());
        $this->smarty->assign('email',$user->getEmail());
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
    public function loginOk($array,$user) {
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('array_post_home', $array);
        $this->smarty->assign('username',$user->getUserName());
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
}