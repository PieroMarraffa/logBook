<?php


class CUser
{
    /**
     * @throws SmartyException
     */
    static function home(){
        $pm = FPersistentManager::getInstance();
        $view = new VUser();
        $result=$pm->loadPostHomePage();
        $image=array();
        foreach ($result as $r){
            $t=$pm->load("IDpost",$r->getPostID(),FTravel::getClass());
            $i=$pm->load("IDtravel",$t->getTravelID(),FImage::getClass());
            $image[]=$i;
        }
        $view->home($result,$image);
    }

    /**
     * Metodo che verifica se l'utente è loggato
     * @throws SmartyException
     */
    static function isLogged() {
        $identificato = false;
        if (UCookie::getIsSet('PHPSESSID')) {
            if (session_status() == PHP_SESSION_NONE) {
                //header('Cache-Control: no cache'); //no cache
                //session_cache_limiter('private_no_expire'); // works
                //session_cache_limiter('public'); // works too
                USession::getInstance();
            }
        }
        if (USession::getIsSet('user')) {
            $identificato = true;
            self::isBanned();
        }
        return $identificato;
    }

    /**
     * @throws SmartyException
     */
    static function isBanned(){
        $user = unserialize(USession::getElement('user'));
        $pm=FPersistentManager::getInstance();
        $view=new VUser();
        $u=$pm->load("IDuser",$user->getUserID(),FUser::getClass());
        if($u->isBanned()==true){
            USession::unsetSession();
            USession::destroySession();
            $view->loginBann();

        }
    }


    /**
     * @throws SmartyException
     */
    static function login(){
        $pm = FPersistentManager::getInstance();
        //se nell'url viene immesso il pattern /User/login
        if(UServer::getRequestMethod()=="GET"){   //Serve a controllare quello che viene scritto all'interno della url, se viene scritto nell'url può essere solo un reindirizzamento ad un'altra pagina
            if(static::isLogged()) {
                $utente = unserialize(USession::getElement('user'));
                $adm = $pm->loadAdmin("Email", $utente->getMail());
                if (isset($adm))
                    header('Location: /logBook/Admin/adminHome');

                $view = new VUser();
                //$result=$pm->loadPostHomePage();
                //$view->loginOk($result);
                header('Location: /logBook/User/home');
            }
            else{
                $view=new VUser();
                $view->showFormLogin();
            }
        }
        //se viene richiamato il metodo login attraverso una richiesta POST
        //Vuol dire che si sta cercando di accedere all'account premendo sul pulsante di login dopo aver inserito le credenziali
        elseif (UServer::getRequestMethod()=="POST")
            static::checkLogin();
    }


    /**
     * @throws SmartyException
     */
    static function checkLogin(){
        if(UServer::getRequestMethod()!='GET') {
            $view = new VUser();
            $pm = FPersistentManager::getInstance();
            $exist = $pm->loadLogin($_POST['email'], $_POST['password']);
            $admin = $pm->loadAdmin("IDadmin", 1);
            $adminEmail = $admin->getMail();
            $adminPassword = $admin->getPassword();
            if ($exist == true) {
                $user = $pm->load("Email", $_POST['email'], "FUser");
                if ($user != null && $user->isBanned() != true) {
                    if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                        USession::getInstance();
                        $salvare = serialize($user);
                        USession::setElement('user', $salvare);
                        header('Location: /logBook/User/home');
                    }
                } elseif ($user->isBanned() == true) {
                    $view->loginBann();
                }
            } elseif ($adminEmail == $_POST['email'] && $adminPassword == $_POST['password']) {
                if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                    USession::getInstance();
                    $salvare = serialize($admin);
                    USession::setElement('admin', $salvare);

                    header('Location: /logBook/Admin/adminHome');
                }

            } else {
                $view->loginError();
            }
        }else header('Location: /logBook/User/home');
    }


    /**
     * @throws SmartyException
     */
    static function profile(){
        $view = new VUser();
        $pm = FPersistentManager::getInstance();
        if(UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                USession::getInstance();
                $user=unserialize(USession::getElement('user'));
                $img=$pm->load("IDimage",$user->getImageID(),'FImage');
                $arrayP=$pm->load("IDuser",$user->getUserID(),"FPost");
                if(!is_array($arrayP)){
                    $arrayPost=array();
                    $arrayPost[]=$arrayP;
                }else $arrayPost=$arrayP;
                if($arrayPost!=null){
                    foreach ($arrayPost as $a){
                        if($a !=null) {
                            if ($a->getDeleted() == true) {
                                unset($arrayPost[array_search($a, $arrayPost, true)]);
                            }
                        }
                    }
                }
                $image=array();
                if($arrayPost!=null) {
                    foreach ($arrayPost as $r) {
                        if($r !=null) {
                            $t = $pm->load("IDpost", $r->getPostID(), FTravel::getClass());
                            $i = $pm->load("IDtravel", $t->getTravelID(), FImage::getClass());
                            $image[] = $i;
                        }
                    }
                }
                $arrayPlace=$pm->loadPlaceByUser($user->getUserID());
                $view->profile($user,$img,$arrayPost,$arrayPlace,$image);
            }
        } else
                header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function registration(){
        if(UServer::getRequestMethod()=="GET") {
            $view = new VUser();
            if (static::isLogged()) {
                header('Location: /logBook/User/home');
            }
            else {
                $view->registration_form();             //Reindirizza alla schermata di registrazione
            }
        }else if(UServer::getRequestMethod()=="POST") {
            static::checkRegistration();
        }
    }

    /**
     * @throws SmartyException
     */
    static function checkRegistration(){
        if(UServer::getRequestMethod()!='GET') {
            $pm = FPersistentManager::getInstance();
            $verifiemail = $pm->exist("Email", $_POST['email'],"FUser");
            $view = new VUser();
            if ($verifiemail){
                $view->registrationError("email");}
            else{
                $user = new EUser($_POST['email'], $_POST['password'],$_POST['name'],"", null,$_POST['username'],false,false);
                if ($user != null) {
                    if (isset($_FILES['file'])) {
                        $nome_file = 'file';
                        $img = static::upload($user,$nome_file);
                        switch ($img) {
                            case "size":
                                $view->registrationError("size");
                                break;
                            case "type":
                                $view->registrationError("type");
                                break;
                            case "ok":
                                header('Location: /logBook/User/login');
                                break;
                        }
                    }
                }
            }
        }else header('Location: /logBook/User/home');
    }

    static function upload($user,$nome_file) {
        if(UServer::getRequestMethod()!='GET') {
            $pm = FPersistentManager::getInstance();
            $max_size = 600000000;
            $result = is_uploaded_file($_FILES[$nome_file]['tmp_name']);
            if (!$result) {
                //no immagine
                $pm->store($user);
                $ris = "ok";
            }
            else {
                $size = $_FILES[$nome_file]['size'];
                $type = $_FILES[$nome_file]['type'];
                if ($size > $max_size) {
                    //Il file è troppo grande
                    $ris = "size";
                }
                elseif ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                    $size = $_FILES[$nome_file]['size'];
                    $type = $_FILES[$nome_file]['type'];
                    $immagine = file_get_contents($_FILES[$nome_file]['tmp_name']);
                    $immagine = addslashes($immagine);
                    $profile_image= new EImage($immagine,null,$size,$type);
                    $id=$pm->storeMedia($profile_image,$nome_file);
                    $user->setImageID($id);
                    $pm->store($user);
                    //L'inserimento è adnato a buon fine, l'immagine e il nuovo user sono stati inseriti correttamente
                    $ris = "ok";
                }
                else {
                    //formato diverso
                    $ris = "type";
                }
            }
            return $ris;
        }else header('Location: /logBook/User/home');
    }

    /**
     * Funzione che provvede alla rimozione delle variabili di sessione, alla sua distruzione e a rinviare alla homepage
     */
    static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function changeCredential(){
        $pm = FPersistentManager::getInstance();
        $view = new VUser();
        USession::getInstance();
        $user = unserialize(USession::getElement('user'));
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $img=$pm->load("IDimage",$user->getImageID(),'FImage');
                $view->changeCredentialForm($user,$img);
            } else
                header('Location: /logBook/User/login');
        }
        elseif (UServer::getRequestMethod() =="POST"){
            if(isset($_POST['email'])){
                $id=$user->getUserID();
                $pm->update('Email',$_POST['email'],$id,FUser::getClass());
                $u=$pm->load('IDuser',$id,FUser::getClass());
                $salvare = serialize($u);
                USession::setElement('user',$salvare);
                header('Location: /logBook/User/profile');

            }
            elseif (isset($_POST['new_password'])){
                $id=$user->getUserID();
                $pm->update('Password',$_POST['new_password'],$id,FUser::getClass());
                $u=$pm->load('IDuser',$id,FUser::getClass());
                $salvare = serialize($u);
                USession::setElement('user',$salvare);
                header('Location: /logBook/User/profile');
            }
            elseif (isset($_POST['username'])){
                $exist=$pm->exist("Username",$_POST['username'],FUser::getClass());
                if(!$exist){
                $id=$user->getUserID();
                $pm->update('Username',$_POST['username'],$id,FUser::getClass());
                $u=$pm->load('IDuser',$id,FUser::getClass());
                $salvare = serialize($u);
                USession::setElement('user',$salvare);
                header('Location: /logBook/User/profile');}
                else{
                    $view->updateUserNameError();
                }
            }
            elseif (isset($_FILES['file'])){
                $id=$user->getUserID();
                $array_immagini=$pm->load("IDtravel",null,FImage::getClass());
                foreach ($array_immagini as $a){
                    if($a['IDuser']==$id){
                        $pm->delete("IDimage",$a->getImageID(),FImage::getClass());
                    }
                }
                    $nome_file = 'file';
                    $img = static::updateImage($user,$nome_file);
                    switch ($img) {
                        case "size":
                            $view->updateImageError("size");
                            break;
                        case "type":
                            $view->updateImageError("type");
                            break;
                        case "ok":
                            header('Location: /logBook/User/profile');
                            break;
                    }
            }
            elseif (isset($_POST['description'])){
                $id=$user->getUserID();
                $pm->update('Description',$_POST['description'],$id,FUser::getClass());
                $u=$pm->load('IDuser',$id,FUser::getClass());
                $salvare = serialize($u);
                USession::setElement('user',$salvare);
                header('Location: /logBook/User/profile');
            }
        }
    }

    static function changePassword(){
        $view=new VUser();
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $view->changePassword();
            }else
                header('Location: /logBook/User/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeEmail(){
        $view=new VUser();
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $view->changeEmail();
            }else
                header('Location: /logBook/User/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeUsername(){
        $view=new VUser();
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $view->changeUsername();
            }else
                header('Location: /logBook/User/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeImage(){
        $view=new VUser();
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $view->changeImage();
            }else
                header('Location: /logBook/User/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeDescription(){
        $view=new VUser();
        if (UServer::getRequestMethod() == "GET") {
            if (CUser::isLogged()) {
                $view->changeDescription();
            }else
                header('Location: /logBook/User/login');
        }
    }

    static function updateImage($user,$nome_file) {
        if(UServer::getRequestMethod()!='GET'){
            $pm = FPersistentManager::getInstance();
            $max_size = 600000;
            $result = is_uploaded_file($_FILES[$nome_file]['tmp_name']);
            if (!$result) {
                //no immagine
                $ris = "ok";

            } else {
                $size = $_FILES[$nome_file]['size'];
                $type = $_FILES[$nome_file]['type'];
                if ($size > $max_size) {
                    //Il file è troppo grande
                    $ris = "size";
                }
                elseif ($type == 'image/jpeg' || $type == 'image/jpg'|| $type == 'image/png' ) {
                    $size = $_FILES[$nome_file]['size'];
                    $type = $_FILES[$nome_file]['type'];
                    $immagine = file_get_contents($_FILES[$nome_file]['tmp_name']);
                    $immagine = addslashes($immagine);
                    $profile_image= new EImage($immagine,null,$size,$type);
                    $id=$pm->storeMedia($profile_image,$nome_file);
                    $pm->update("Image",$id,$user->getUserID(),FUser::getClass());
                    $u=$pm->load("IDuser",$user->getUserID(),FUser::getClass());
                    $salvare = serialize($u);
                    USession::setElement('user',$salvare);
                    $ris = "ok";
                }
                else {
                    //formato diverso
                    $ris = "type";
                }
            }
            return $ris;
        }
        else{ header('Location: /logBook/User/profile');}
    }


}