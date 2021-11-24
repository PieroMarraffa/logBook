<?php


class CPost{
    /**
     * @throws Exception
     */
    public static function savePost($postID)
    {
        if(CUser::isLogged()) {
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            $user = unserialize(USession::getElement('user'));
            if ($postID == NULL) {
                if (!isset($_POST['titleExperience']) || $_POST['title'] == NULL) {
                    header('Location: /logBook/User/profile');
                } else {
                    $arrayExperienceTitle = $_POST['titleExperience'];
                    $arrayStartDay = $_POST['startDate'];
                    $arrayEndDay = $_POST['endDate'];
                    $arrayPlaceName = $_POST['placeName'];
                    $arrayDescription = $_POST['description'];
                    $ExpList = array();
                    for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
                        $Etitle = $arrayExperienceTitle[$i];
                        $EstartDate = $arrayStartDay[$i];
                        $EfinishDate = $arrayEndDay[$i];
                        $Edescriprion = $arrayDescription[$i];

                        $ad = explode(' ', $arrayPlaceName[$i]);
                        $address = implode('+', $ad);
                        $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw");
                        $array = json_decode($json, true);
                        if ($array["status"] != "ZERO_RESULTS") {
                            $result = array();
                            if (count($array["results"]) == 1){
                                $result = $array["results"][0];
                            } elseif (count($array["results"]) > 1){
                                foreach ($array["results"] as $r){
                                    foreach ($r["address_components"] as $component){
                                        if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                                            $result = $r;
                                            break;
                                        }
                                    }
                                }
                            }
                            if ($result != NULL){
                                foreach ($result["address_components"] as $component) {
                                    if ($component["types"][0] == "country" && $component["types"][0] != NULL) {
                                        $countryName = $component["long_name"];
                                    }
                                }
                                $lat = $result["geometry"]["location"]["lat"];
                                $lng = $result["geometry"]["location"]["lng"];
                                $Eplace = new EPlace($lat, $lng, $arrayPlaceName[$i], $countryName);

                                if ($Etitle != '' && $EstartDate != '' && $EfinishDate != '' && $Edescriprion != '') {
                                    $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
                                    $ExpList[] = $exp;
                                }
                            }
                        }
                    }
                    if (count($ExpList) > 0) {
                        $title = $_POST['title'];
                        $TravelDays = FPost::lowerAndHigherDate($ExpList);
                        $DayOne = $TravelDays[0];
                        $LastDay = $TravelDays[1];
                        $date = date("Y-m-d h:i:s");
                        $userID = $user->getUserID();
                        $deleted = 0;
                        $post = new EPost(array(), array(), $date, $deleted, array(), array(), $userID, $title, $ExpList, $DayOne, $LastDay);
                        $postID = $pm->store($post);

                        foreach ($ExpList as $exp) {

                            $toSave = true;
                            $allPlaces = $pm->loadAll(FPlace::getClass());
                            if($allPlaces!=null) {
                                foreach ($allPlaces as $ap) {
                                    if ($ap->getLatitude() == $exp->getPlace()->getLatitude() && $ap->getLongitude() == $exp->getPlace()->getLongitude()) {
                                        $exp->setPlace($ap);
                                        $toSave = false;
                                    }
                                }
                                if ($toSave == true) {
                                    $placeID = FPlace::store($exp->getPlace());
                                    $exp->setPlaceID($placeID);
                                }
                            }else{
                                $placeID = FPlace::store($exp->getPlace());
                                $exp->setPlaceID($placeID);
                            }
                            $exp->setPostID($postID);
                            $pm->store($exp);
                        }
                    } else{
                        header('Location: /logBook/User/profile');
                    }
                }

            }else {
                if (!isset($_POST['titleExperience']) || $_POST['title'] == NULL) {
                    self::annullaModifiche($postID);
                } else {
                    $arrayExperienceTitle = $_POST['titleExperience'];
                    $arrayStartDay = $_POST['startDate'];
                    $arrayEndDay = $_POST['endDate'];
                    $arrayPlaceName = $_POST['placeName'];
                    $arrayDescription = $_POST['description'];
                    $ExpList = array();
                    for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
                        $Etitle = $arrayExperienceTitle[$i];
                        $EstartDate = $arrayStartDay[$i];
                        $EfinishDate = $arrayEndDay[$i];
                        $Edescriprion = $arrayDescription[$i];

                        $ad = explode(' ', $arrayPlaceName[$i]);
                        $address = implode('+', $ad);
                        $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw");
                        $array = json_decode($json, true);
                        if ($array["status"] != "ZERO_RESULTS") {
                            $result = array();
                            if (count($array["results"]) == 1){
                                $result = $array["results"][0];
                            } elseif (count($array["results"]) > 1){
                                foreach ($array["results"] as $r){
                                    foreach ($r["address_components"] as $component){
                                        if ($component["types"][0] == "country" && $component["types"][0] != NULL){
                                            $result = $r;
                                            break;
                                        }
                                    }
                                }
                            }
                            if ($result != NULL){
                                foreach ($result["address_components"] as $component) {
                                    if ($component["types"][0] == "country" && $component["types"][0] != NULL) {
                                        $countryName = $component["long_name"];
                                    }
                                }
                                $lat = $result["geometry"]["location"]["lat"];
                                $lng = $result["geometry"]["location"]["lng"];
                                $Eplace = new EPlace($lat, $lng, $arrayPlaceName[$i], $countryName);

                                if ($Etitle != '' && $EstartDate != '' && $EfinishDate != '' && $Edescriprion != '') {
                                    $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
                                    $ExpList[] = $exp;
                                }
                            }
                        }
                    }
                    if (count($ExpList) > 0) {
                        $post = $pm->load("IDpost", $postID, FPost::getClass());
                        $titlePost = $_POST['title'];
                        $pm->update('Title', $titlePost, $post->getPostID(), FPost::getClass());
                        $arrayOriginalExperience = $post->getExperienceList();
                        foreach ($arrayOriginalExperience as $expO) {
                            $pm->delete('IDexperience', $expO->getExperienceID(), FExperience::getClass());
                        }
                        $postID = $post->getPostID();

                        foreach ($ExpList as $exp) {

                            $toSave = true;
                            $allPlaces = $pm->loadAll(FPlace::getClass());
                            foreach ($allPlaces as $ap) {
                                if ($ap->getLatitude() == $exp->getPlace()->getLatitude() && $ap->getLongitude() == $exp->getPlace()->getLongitude()) {
                                    $exp->setPlace($ap);
                                    $toSave = false;
                                }
                            }
                            if ($toSave == true) {
                                $placeID = FPlace::store($exp->getPlace());
                                $exp->setPlaceID($placeID);
                            }
                            $exp->setPostID($postID);
                            $pm->store($exp);
                        }

                        $immagini = $pm->load('IDpost', $postID, FImage::getClass());
                        foreach ($immagini as $item) {
                            if ($item->getImageID() < 0) {
                                $pm->delete('IDimage', $item->getImageID(), FImage::getClass());
                            }
                        }
                    } else{
                        header('Location: /logBook/User/profile');
                    }
                }
            }


            for ($numImg = 2; isset($_FILES['image' . $numImg]); $numImg++) {
                $nome_file = 'image' . $numImg;
                $img = static::upload($postID, $nome_file);
                switch ($img) {
                    case "size":
                        //$view->registrationError("size");
                        break;
                    case "type":
                        //$view->registrationError("type");
                        break;
                    case "ok":
                        //header('Location: /logBook/User/profile');
                        break;
                }
            }
            header('Location: /logBook/User/profile');
        }
    }

    /**
     * @throws SmartyException
     */
    public static function create_post(){
        if(CUser::isLogged()) {
            $view = new VPost();
            $view->create_post(true, NULL);
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     * @throws Exception
     */
    public static function deletePost($postID){
        if(CUser::isLogged()) {
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            $user = unserialize(USession::getElement('user'));
            if ($user->getUserID() == $pm->getUserByPost($postID)) {
                $post = $pm->load('IDpost', $postID, FPost::getClass());
                $pm->deleteFromPostReported($postID);
                $pm->deleteFromReaction($postID);
                $pm->delete('IDpost', $postID, FComment::getClass());
                $pm->delete('IDpost', $post->getPostID(), FExperience::getClass());
                $pm->delete('IDpost', $post->getPostID(), FImage::getClass());
                $pm->delete('IDpost', $postID, FPost::getClass());

                header('Location: /logBook/User/profile');
            } else{
                header('Location: /logBook/User/home');
            }
        }else{
            header('Location: /logBook/User/login');
        }
    }

    /**
     * @throws SmartyException
     */
    public static function deleteExistingExperience($id, $postID){
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            $pm->update('IDexperience', -$id, $id, FExperience::getClass());
            self::modify_post($postID);
        }else header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    public static function deleteExistingImage($id, $postID){
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            $pm->update('IDimage', -$id, $id, FImage::getClass());
            self::modify_post($postID);
        }else header('Location: /logBook/User/login');
    }


    /**
     * @throws SmartyException
     */
    static function upload($postID, $nome_file) {
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            $max_size = 600000000;
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
                $immagine = addslashes ($immagine);
                $image= new EImage($immagine,$postID,$size,$type);
                $pm->storeMedia($image,$nome_file);
                $ris = "ok";
            }
            else {
                //formato diverso
                $ris = "type";
            }

            return $ris;
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     * @throws Exception
     */
    static function modify_post($postID){
        if(CUser::isLogged()) {
            USession::getInstance();
            $view = new VPost();
            $pm = FPersistentManager::getInstance();
            $user = unserialize(USession::getElement('user'));
            if ($user->getUserID() == $pm->getUserByPost($postID)) {
                $post = $pm->load("IDpost",$postID,FPost::getClass());
                $image = $pm->load("IDpost", $post->getPostID(), FImage::getClass());
                $arrayExperience = $post->getExperienceList();
                $arrayExperienceDaVedere = array();
                foreach ($arrayExperience as $exp){
                    if ($exp->getExperienceID() > 0){
                        $arrayExperienceDaVedere[] = $exp;
                    }
                }
                $imageDaVedere = array();
                foreach ($image as $i){
                    if($i->getImageID() > 0){
                        $imageDaVedere[] = $i;
                    }
                }
                $numero = 2;
                $view->modify_post($post, $arrayExperienceDaVedere, $numero, $postID, $imageDaVedere,false);
            } else{
                header('Location: /logBook/User/home');
            }
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     * @throws Exception
     */
    static function annullaModifiche($postID){
        if(CUser::isLogged()) {
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            $user = unserialize(USession::getElement('user'));
            if ($user->getUserID() == $pm->getUserByPost($postID)) {
                $post = $pm->load("IDpost",$postID,FPost::getClass());
                $image = $pm->load("IDpost", $post->getPostID(), FImage::getClass());
                $arrayExperience = $post->getExperienceList();
                foreach ($arrayExperience as $exp) {
                    if ($exp->getExperienceID() < 0) {
                        $pm->update('IDexperience', -$exp->getExperienceID(), $exp->getExperienceID(), FExperience::getClass());
                    }
                }
                foreach ($image as $i){
                    if ($i->getImageID() < 0){
                        $pm->update('IDimage', -$i->getImageID(), $i->getImageID(), FImage::getClass());
                    }
                }
                header('Location: /logBook/Research/postDetail/' . $postID);
            }
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     */
    static function writeComment($IDpost){
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            $exist=$pm->exist("IDpost",$IDpost,FPost::getClass());
            if($exist) {
                USession::getInstance();
                $user = unserialize(USession::getElement('user'));
                $content = $_POST['comment'];
                if ($content != null) {
                    $comment = new EComment($IDpost, $user, null, $content);
                    $pm->store($comment);
                }
            }
            header('Location: /logBook/Research/postDetail/' . $IDpost);
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     */
    static function like($IDpost,$value){
        if (CUser::isLogged()) {
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            $exist = $pm->exist("IDpost", $IDpost, FPost::getClass());
            if ($exist){
                $user = unserialize(USession::getElement('user'));
            if ($value == 1 || $value == -1) {
                $reaction = new ELike($value, $user->getUserID(), $IDpost);

                $result = $pm->load('IDuser', $user->getUserID(), FLike::getClass());
                if ($result == null) {
                    $pm->store($reaction);
                    header('Location: /logBook/Research/postDetail/' . $IDpost);
                } else {
                    if (is_object($result)) {
                        if ($result->getPostID() != $IDpost) {
                            $pm->store($reaction);
                        }
                        header('Location: /logBook/Research/postDetail/' . $IDpost);
                    } else {
                        $exist = false;
                        foreach ($result as $res) {
                            if ($res->getPostID() == $IDpost) {
                                $exist = true;
                                break;
                            }
                        }
                        if ($exist != true) {
                            $pm->store($reaction);
                        }
                        header('Location: /logBook/Research/postDetail/' . $IDpost);

                    }
                }
            } else {
                header('Location: /logBook/Research/postDetail/' . $IDpost);
            }
        }
        } else{
            header('Location: /logBook/Research/postDetail/' . $IDpost);
        }
    }



}
