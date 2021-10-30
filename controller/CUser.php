<?php

require 'utility/UCookie.php';
require 'utility/USession.php';
require 'utility/UServer.php';


class CUser
{
    /**
     * @throws SmartyException
     */
    static function home(){
        $pm = new FPersistentManager();
        $view = new VUser();
        $result=array();
        $result[] = $pm->load("IDpost",1,FPost::getClass());       /** DA CAMBIARE L'HO MESSA SOLO PER PROVARE */
        $result[] = $pm->load("IDpost",2,FPost::getClass());      //Carica i post che devono stare nella schermata di home
        $result[] = $pm->load("IDpost",3,FPost::getClass());
        $result[] = $pm->load("IDpost",4,FPost::getClass());
        $view->home($result);
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
        $pm=new FPersistentManager();
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
        //se nell'url viene immesso il pattern /User/login
        if($_SERVER['REQUEST_METHOD']=="GET"){   //Serve a controllare quello che viene scritto all'interno della url, se viene scritto nell'url può essere solo un reindirizzamento ad un'altra pagina
            if(static::isLogged()) {
                $utente = unserialize(USession::getElement('user'));
                $adm = FPersistentManager::loadAdmin("Email", $utente->getMail());
                if (isset($adm))
                    header('Location: /logBook/Admin/adminHome');
                $pm = new FPersistentManager();
                $view = new VUser();
                $result=$pm->loadPostHomePage();
                $view->loginOk($result);
            }
            else{
                $view=new VUser();
                $view->showFormLogin();
            }
        }
        //se viene richiamato il metodo login attraverso una richiesta POST
        //Vuol dire che si sta cercando di accedere all'account premendo sul pulsante di login dopo aver inserito le credenziali
        elseif ($_SERVER['REQUEST_METHOD']=="POST")
            static::checkLogin();
    }


    /**
     * @throws SmartyException
     */
    static function checkLogin(){
        $view = new VUser();
        $pm = new FPersistentManager();
        $exist = $pm->loadLogin($_POST['email'], $_POST['password']);
        $admin=$pm->loadAdmin("IDadmin",1);
        $adminEmail=$admin->getMail();
        $adminPassword=$admin->getPassword();
        if($exist==true){
            $user=$pm->load("Email",$_POST['email'],"FUser");
        if ($user != null && $user->isBanned() != true) {
            if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                USession::getInstance();
                $salvare = serialize($user);
                USession::setElement('user',$salvare);
                header('Location: /logBook/User/home');
            }
        }elseif($user->isBanned() == true){
            $view->loginBann();
        }
        }
        elseif ($adminEmail==$_POST['email']&& $adminPassword==$_POST['password']){
            if (USession::getSessionStatus() == PHP_SESSION_NONE) {
                USession::getInstance();
                $salvare = serialize($admin);
                USession::setElement('user',$salvare);

                header('Location: /logBook/Admin/adminHome');
            }

        }
        else {
            $view->loginError();
        }
    }


    /**
     * @throws SmartyException
     */
    static function profile(){
        $view = new VUser();
        $pm = new FPersistentManager();
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                USession::getInstance();
                $user=unserialize(USession::getElement('user'));
                $img=$pm->load("IDimage",$user->getImageID(),'FImage');
                $arrayPost=$pm->load("IDuser",$user->getUserID(),"FPost");
                if($arrayPost!=null){
                    foreach ($arrayPost as $a){
                        if($a->getDeleted()==true){
                            unset($arrayPost[array_search($a,$arrayPost,true)]);
                        }
                    }
                }
                $arrayPlace=$pm->loadPlaceByUser($user->getUserID());  /** RICORDATI DI MODIFICARLO (LOADPLACEBYUSER) PERCHE' SENNO' TI FA VEDERE I MARKER A CASO SULLA MAPPA*/
                $view->profile($user,$img,$arrayPost,$arrayPlace);
            }
        } else
                header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function registration(){
        if($_SERVER['REQUEST_METHOD']=="GET") {
            $view = new VUser();
            $pm = new FPersistentManager();
            if (static::isLogged()) {
                USession::getInstance();
                $user=unserialize(USession::getElement('user'));
                $result=array();/** DA CAMBIARE L'HO MESSA SOLO PER PROVARE */
                $result[] = $pm->load("IDpost",1,FPost::getClass());
                $result[] = $pm->load("IDpost",2,FPost::getClass());      //Carica i post che devono stare nella schermata di home
                $result[] = $pm->load("IDpost",3,FPost::getClass());
                $result[] = $pm->load("IDpost",4,FPost::getClass());
                $view->loginOk($result);
            }
            else {
                $view->registration_form();             //Reindirizza alla schermata di registrazione
            }
        }else if($_SERVER['REQUEST_METHOD']=="POST") {
            static::checkRegistration();
        }
    }

    /**
     * @throws SmartyException
     */
    static function checkRegistration(){
            $pm = new FPersistentManager();
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
    }

    static function upload($user,$nome_file) {
        $pm = new FPersistentManager();
        $max_size = 600000;
        $result = is_uploaded_file($_FILES[$nome_file]['tmp_name']);
        echo $result;
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
        $pm = new FPersistentManager();
        $view = new VUser();
        USession::getInstance();
        $user = unserialize(USession::getElement('user'));
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $img=$pm->load("IDimage",$user->getImageID(),'FImage');
                $view->changeCredentialForm($user,$img);
            } else
                header('Location: /logBook/User/login');
        }
        elseif ($_SERVER['REQUEST_METHOD']=="POST"){
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
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $view->changePassword();
            }else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeEmail(){
        $view=new VUser();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $view->changeEmail();
            }else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeUsername(){
        $view=new VUser();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $view->changeUsername();
            }else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeImage(){
        $view=new VUser();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $view->changeImage();
            }else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    /**
     * @throws SmartyException
     */
    static function changeDescription(){
        $view=new VUser();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $view->changeDescription();
            }else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    static function updateImage($user,$nome_file) {
        $pm = new FPersistentManager();
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

}