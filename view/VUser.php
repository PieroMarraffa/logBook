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
    public function loginForm(){
        $this->smarty->display('login.tpl');
    }

    public function signupForm(){
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
}