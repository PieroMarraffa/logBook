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
    public function adminHomepage( $array_banned,$array_reported){
        $this->smarty->assign('userReported', $array_reported);
        $this->smarty->assign('userBanned', $array_banned);
        $this->smarty->display('admin_reported_user.tpl');
    }

    public function loginForm(){
        $this->smarty->display('login.tpl');
    }

    public function toReportedComments($array){
        $this->smarty->assign('reportedComments', $array);
        $this->smarty->display('admin_reported_comment.tpl');
    }

    public function toReportedUsers($array){
        $this->smarty->assign('reportedComments', $array);
        $this->smarty->display('admin_reported_user.tpl');
    }
}