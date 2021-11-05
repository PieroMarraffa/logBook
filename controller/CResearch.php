<?php


class CResearch
{

    /**
     * @throws SmartyException
     * @throws Exception
     */
    static function find(){
        if(UServer::getRequestMethod()!='GET') {
            $view = new VResearch();
            $pm = FPersistentManager::getInstance();
            $research = $_POST['research'];
            if ($_POST['search'] == 1) {
                $post1 = array();
                if ($_POST['research'] != "") {
                    $result = $pm->load("Username", $_POST['research'], FUser::getClass());
                    $array_user = array();
                    if ($result != null) {
                        $array_u = array();
                        if (!is_array($result)) {
                            $array_u[] = $result;
                        } else $array_u = $result;
                        foreach ($array_u as $r) {
                            if ($r->isBanned() != true) {
                                $array_user[] = $r;
                            }
                        }
                    }
                    if ($array_user != null) {
                        foreach ($array_user as $a) {
                            $post = $pm->load("IDuser", $a->getUserID(), FPost::getClass());
                            $array_post = array();
                            if ($post != null) {
                                if (is_object($post)) {
                                    $array_p = array();
                                    $array_p[] = $post;
                                } else $array_p = $post;
                                foreach ($array_p as $p) {
                                    if ($p != null) {
                                        if ($p->getDeleted() != true) {
                                            $array_post[] = $p;
                                        }
                                    }
                                }
                            }
                            $post1[] = $array_post;
                        }

                        $view->search_user($array_user, $post1);
                    } else {
                        $view->search_error($research);
                    }

                } else header("Location: /logBook/User/home");
            } elseif ($_POST['search'] == 2) {
                if ($_POST['research'] != "") {
                    $place = $pm->load("Name", $_POST['research'], FPlace::getClass());
                    if ($place != null) {
                        $post = $pm->loadPostByPlace($place->getPlaceID());
                        $array_posts = array();
                        if ($post != null) {
                            if (is_object($post)) {
                                $array_p = array();
                                $array_p[] = $post;
                            } else $array_p = $post;
                            foreach ($array_p as $p) {
                                if ($p != null) {
                                    if ($p->getDeleted() != true) {
                                        $array_posts[] = $p;
                                    }
                                }
                            }
                        }
                        $image = array();
                        foreach ($array_posts as $r) {
                            $t = $pm->load("IDpost", $r->getPostID(), FTravel::getClass());
                            $i = $pm->load("IDtravel", $t->getTravelID(), FImage::getClass());
                            $image[] = $i;
                        }
                        $view->search_place($place, $array_posts, $image);
                    } else {
                        $view->search_error($research);
                    }
                } else header("Location: /logBook/User/home");
            }
        }else header("Location: /logBook/User/home");
    }

    /**
     * @throws SmartyException
     */
    static function postDetail($id){
        $pm = FPersistentManager::getInstance();
        $view=new VResearch();
        if(UServer::getRequestMethod() == "GET") {
            $post = $pm->load("IDpost", $id, FPost::getClass());
            if($post->getDeleted()!=true){
                $author=$pm->load("IDuser",$post->getUserID(),FUser::getClass());
                $travel=$pm->load("IDpost",$post->getPostID(),FTravel::getClass());
                $images=$pm->load("IDtravel",$travel->getTravelID(),FImage::getClass());
                $experience=$post->getTravel()->getExperienceList();
                if (is_object($experience)) {
                    $array_e = array();
                    $array_e[] = $experience;
                } else $array_e = $experience;
                $array_place=array();
                foreach ($array_e as $e){
                    $array_place[]=$e->getPlace();
                }
                $view->post($post,$author,$array_place,$images);
            }
            else{
                header("Location: /logBook/User/home");
            }
        }
    }

    /**
     * @throws SmartyException
     */
    static function reportPost($idPost){
        $pm= FPersistentManager::getInstance();
        if(UServer::getRequestMethod()=='GET'){
            if(CUser::isLogged()){
                $u=USession::getElement('user');
                $user=unserialize($u);
                $reporter=$pm->loadPostReporter($idPost);
                if($reporter==null){
                    $pm->storePostReporter($user->getUserID(),$idPost);
                }elseif(!is_array($reporter)) {
                    if($reporter->getUserName()!=$reporter->getUserName()){
                        $pm->storeCommentReporter($user->getUserID(),$idPost);
                    }
                }else{
                    foreach($reporter as $r){
                        if($r->getUserName()==$user->getUserName()){
                            $report=true;
                            break;
                        }else{
                            $report=false;
                        }
                    }
                    if($report==false){
                        $pm->storeCommentReporter($user->getUserID(),$idPost);
                    }
                }
                header('Location: /logBook/Research/postDetail/'.$idPost .'');
            }
        }
    }

    /**
     * @throws SmartyException
     */
    static function profileDetail($id){
        $pm = FPersistentManager::getInstance();
        $view=new VResearch();
        if(UServer::getRequestMethod() == "GET") {
            $user = $pm->load("IDuser", $id, FUser::getClass());
            if(CUser::isLogged()){
                USession::getInstance();
                $u = USession::getElement('user');
                $utente = unserialize($u);
                if ($user->getUserID() == $utente->getUserID()) {
                    header("Location: /logBook/User/profile");
                } else {
                    $img = $pm->load("IDimage", $user->getImageID(), 'FImage');
                    $arrayPost = $pm->load("IDuser", $user->getUserID(), "FPost");
                    if ($arrayPost != null) {
                        foreach ($arrayPost as $a) {
                            if ($a->getDeleted() == true) {
                                unset($arrayPost[array_search($a, $arrayPost, true)]);
                            }
                        }
                    }
                    $image = array();
                    foreach ($arrayPost as $r) {
                        $t = $pm->load("IDpost", $r->getPostID(), FTravel::getClass());
                        $i = $pm->load("IDtravel", $t->getTravelID(), FImage::getClass());
                        $image[] = $i;
                    }
                    $arrayPlace = $pm->loadPlaceByUser($user->getUserID());
                    $view->profileDetail($user, $img, $arrayPost, $arrayPlace, $image);
                }
            }
            else{
                $img = $pm->load("IDimage", $user->getImageID(), 'FImage');
                $arrayPost = $pm->load("IDuser", $user->getUserID(), "FPost");
                if ($arrayPost != null) {
                    foreach ($arrayPost as $a) {
                        if ($a->getDeleted() == true) {
                            unset($arrayPost[array_search($a, $arrayPost, true)]);
                        }
                    }
                }
                $image = array();
                foreach ($arrayPost as $r) {
                    $t = $pm->load("IDpost", $r->getPostID(), FTravel::getClass());
                    $i = $pm->load("IDtravel", $t->getTravelID(), FImage::getClass());
                    $image[] = $i;
                }
                $arrayPlace = $pm->loadPlaceByUser($user->getUserID());
                $view->profileDetail($user, $img, $arrayPost, $arrayPlace, $image);
            }
        }
    }


    static function report($id){
        $pm = FPersistentManager::getInstance();
        $pm->update("Reported",1,$id,FUser::getClass());
        header('Location: /logBook/Research/profileDetail/'.$id);
    }

    /**
     * @throws SmartyException
     */
    static function reportComment($idComment,$idPost){
        $pm= FPersistentManager::getInstance();
        if(UServer::getRequestMethod()=='GET'){
            if(CUser::isLogged()){
                $u=USession::getElement('user');
                $user=unserialize($u);
                $reporter=$pm->loadCommentReporter($idComment);
                if($reporter==null){
                    $pm->storeCommentReporter($user->getUserID(),$idComment);
                }elseif(!is_array($reporter)) {
                    if($reporter->getUserName()!=$reporter->getUserName()){
                        $pm->storeCommentReporter($user->getUserID(),$idComment);
                    }
                }else{
                    foreach($reporter as $r){
                        if($r->getUserName()==$user->getUserName()){
                            $report=true;
                            break;
                        }else{
                            $report=false;
                        }
                    }
                    if($report==false){
                        $pm->storeCommentReporter($user->getUserID(),$idComment);
                    }
                }
                header('Location: /logBook/Research/postDetail/'.$idPost .'');
            }
        }
    }
}