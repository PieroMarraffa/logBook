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
                    $ad = explode(' ', $_POST['research']);
                    $address = implode('+', $ad);
                    $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw");
                    $array = json_decode($json, true);
                    $result = array();
                    if (count($array["results"]) == 1){
                        $result = $array["results"][0];
                    } elseif (count($array["results"]) == 0){
                        $view->search_error($_POST['research']);
                        return true;
                    } else{
                        foreach ($array["results"] as $r){
                            foreach ($r["address_components"] as $component){
                                if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                                    $result = $r;
                                    break;
                                }
                            }
                        }
                    }
                    foreach ($result["address_components"] as $component){
                        if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                            $countryName = $component["long_name"];
                        }
                    }
                    foreach ($result["address_components"] as $component){
                        $assigned = false;
                        if ($component["types"][0] == "locality"){
                            $localityName = $component["long_name"];
                            $assigned = true;
                            break;
                        } elseif($result["formatted_address"] == $countryName){
                            $localityName = $countryName;
                            $assigned = true;
                            break;
                        }
                    }
                    if ($assigned == false){
                        $localityName = explode(', ', $result["formatted_address"])[0];
                    }
                    $lat = $result["geometry"]["location"]["lat"];
                    $lng = $result["geometry"]["location"]["lng"];
                    $place = new EPlace($lat, $lng, $localityName, $countryName);
                    if ($_POST['research'] == $countryName){
                        $post = $pm->loadPostByPlaceCountryName($countryName);
                        $image = array();
                        if(isset($post[0])){
                            foreach ($post as $r) {
                                $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                                $image[] = $i;
                            }
                        }
                        $view->search_place($place, $post, $image, $_POST['research']);
                    } else{
                        $post = $pm->loadPostByProssimity($lat, $lng, 0.1);
                        if ($post == NULL){
                            $view->search_place($place, $post, NULL, $_POST['research']);
                        } else {
                            $image = array();
                            if (isset($post[0])) {
                                foreach ($post as $r) {
                                    $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                                    $image[] = $i;
                                }
                            }
                            $view->search_place($place, $post, $image, $_POST['research']);
                        }
                    }

                } else header("Location: /logBook/User/home");
            }
        }else header("Location: /logBook/User/home");
        return true;
    }

    static function findPlace($namePlace){
        echo var_dump($namePlace);
        $view = new VResearch();
        $pm = FPersistentManager::getInstance();
        if ($namePlace != "") {
            $ad = explode(' ', $namePlace);
            $address = implode('+', $ad);
            $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw");
            $array = json_decode($json, true);
            $result = array();
            if (count($array["results"]) == 1){
                $result = $array["results"][0];
            } elseif (count($array["results"]) == 0){
                $view->search_error($_POST['research']);
                return true;
            } else{
                foreach ($array["results"] as $r){
                    foreach ($r["address_components"] as $component){
                        if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                            $result = $r;
                            break;
                        }
                    }
                }
            }
            foreach ($result["address_components"] as $component){
                if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                    $countryName = $component["long_name"];
                }
            }
            foreach ($result["address_components"] as $component){
                $assigned = false;
                if ($component["types"][0] == "locality"){
                    $localityName = $component["long_name"];
                    $assigned = true;
                    break;
                } elseif($result["formatted_address"] == $countryName){
                    $localityName = $countryName;
                    $assigned = true;
                    break;
                }
            }
            if ($assigned == false){
                $localityName = explode(', ', $result["formatted_address"])[0];
            }
            $lat = $result["geometry"]["location"]["lat"];
            $lng = $result["geometry"]["location"]["lng"];
            $place = new EPlace($lat, $lng, $localityName, $countryName);
            if ($namePlace == $countryName){
                $post = $pm->loadPostByPlaceCountryName($countryName);
                $image = array();
                if(isset($post[0])){
                    foreach ($post as $r) {
                        $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                        $image[] = $i;
                    }
                }
                $view->search_place($place, $post, $image, $namePlace);
            } else{
                $post = $pm->loadPostByProssimity($lat, $lng, 0.1);
                if ($post == NULL){
                    $view->search_place($place, $post, NULL, $namePlace);
                } else {
                    $image = array();
                    if (isset($post[0])) {
                        foreach ($post as $r) {
                            $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                            $image[] = $i;
                        }
                    }
                    $view->search_place($place, $post, $image, $namePlace);
                }
            }

        } else header("Location: /logBook/User/home");
    }

    /**
     * @throws SmartyException
     */
    static function postDetail($id){
        $pm = FPersistentManager::getInstance();
        $view=new VResearch();
        if(UServer::getRequestMethod() == "GET") {
            $exist = $pm->exist("IDpost", $id, FPost::getClass());
            if ($exist) {
                $post = $pm->load("IDpost", $id, FPost::getClass());
                if ($post->getDeleted() != true) {
                    $author = $pm->load("IDuser", $post->getUserID(), FUser::getClass());
                    $images = $pm->load("IDpost", $post->getPostID(), FImage::getClass());
                    $experience = $post->getExperienceList();
                    if (is_object($experience)) {
                        $array_e = array();
                        $array_e[] = $experience;
                    } else $array_e = $experience;
                    $array_place = array();
                    foreach ($array_e as $e) {
                        $array_place[] = $e->getPlace();
                    }
                    $view->post($post, $author, $array_place, $images);
                }
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
            if(CUser::isLogged()) {
                $u = USession::getElement('user');
                $user = unserialize($u);
                $reporter = $pm->loadPostReporter($idPost);
                $post = $pm->load("IDpost", $idPost, FPost::getClass());
                $utente = $pm->load("IDuser", $post->getUserID(), FUser::getClass());
                if ($utente->getMail() != $user->getMail()){
                    if ($reporter == null) {
                        $pm->storePostReporter($user->getUserID(), $idPost);
                    } elseif (!is_array($reporter)) {
                        if ($reporter->getUserName() != $reporter->getUserName()) {
                            $pm->storePostReporter($user->getUserID(), $idPost);
                        }
                    } else {
                        foreach ($reporter as $r) {
                            if ($r->getUserName() == $user->getUserName()) {
                                $report = true;
                                break;
                            } else {
                                $report = false;
                            }
                        }
                        if ($report == false) {
                            $pm->storePostReporter($user->getUserID(), $idPost);
                        }
                    }
                    header('Location: /logBook/Research/postDetail/' . $idPost . '');
                }
                else{header('Location: /logBook/Research/postDetail/' . $idPost . '');}
            }else header('Location: /logBook/User/home');
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
                    if ($user->isBanned() != true) {
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
                        if ($arrayPost != null) {
                            if(!is_array($arrayPost)){
                                $arrayP=array();
                                $arrayP[]=$arrayPost;
                            }else $arrayP=$arrayPost;
                            foreach ($arrayP as $r) {
                                $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                                $image[] = $i;
                            }
                        }
                        $arrayPlace = $pm->loadPlaceByUser($user->getUserID());
                        $view->profileDetail($user, $img, $arrayPost, $arrayPlace, $image);
                    }else header("Location: /logBook/User/home");
                }
            }
            else{
                if ($user->isBanned() != true) {
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
                    if(!is_array($arrayPost)){
                        $arrayP=array();
                        $arrayP[]=$arrayPost;
                    }else $arrayP=$arrayPost;
                foreach ($arrayP as $r) {
                    $i = $pm->load("IDpost", $r->getPostID(), FImage::getClass());
                    $image[] = $i;
                }
                $arrayPlace = $pm->loadPlaceByUser($user->getUserID());
                $view->profileDetail($user, $img, $arrayPost, $arrayPlace, $image);
                }else header("Location: /logBook/User/home");
            }
        }
    }


    /**
     * @throws SmartyException
     */
    static function report($id){
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            USession::getInstance();
            $u = USession::getElement('user');
            $utente = unserialize($u);
            $exist=$pm->exist("IDuser",$id,FUser::getClass());
            if($exist) {
                if ($utente->getUserID() != $id) {
                    $pm->update("Reported", 1, $id, FUser::getClass());
                    header('Location: /logBook/Research/profileDetail/' . $id);
                } else header('Location: /logBook/Research/profileDetail/' . $id);
            }else header('Location: /logBook/User/home');
        }else header('Location: /logBook/Research/profileDetail/' . $id);
    }

    /**
     * @throws SmartyException
     */
    static function reportComment($idComment,$idPost){
        $pm= FPersistentManager::getInstance();
        if(UServer::getRequestMethod()=='GET'){
            if(CUser::isLogged()) {
                $u = USession::getElement('user');
                $user = unserialize($u);
                $exist=$pm->exist("IDcomment",$idComment,FComment::getClass());
                if($exist) {
                    $reporter = $pm->loadCommentReporter($idComment);
                    $comment = $pm->load('IDcomment', $idComment, FComment::getClass());
                    $utente = $pm->load('IDuser', $comment->getAuthorID(), FUser::getClass());
                    if ($user->getMail() != $utente->getMail()) {
                        if ($reporter == null) {
                            $pm->storeCommentReporter($user->getUserID(), $idComment);
                        } elseif (!is_array($reporter)) {
                            if ($reporter->getMail() != $reporter->getMail()) {
                                $pm->storeCommentReporter($user->getUserID(), $idComment);
                            }
                        } else {
                            foreach ($reporter as $r) {
                                if ($r->getMail() == $user->getMail()) {
                                    $report = true;
                                    break;
                                } else {
                                    $report = false;
                                }
                            }
                            if ($report == false) {
                                $pm->storeCommentReporter($user->getUserID(), $idComment);
                            }
                        }
                    }
                    header('Location: /logBook/Research/postDetail/' . $idPost . '');
                }else header('Location: /logBook/User/home');
            }else header('Location: /logBook/Research/postDetail/'.$idPost .'');
        }
    }
}