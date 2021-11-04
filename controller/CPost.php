<?php


class CPost{
    public static function savePost()
    {

        USession::getInstance();
        $view = new VUser();
        $pm = FPersistentManager::getInstance();
        $user = unserialize(USession::getElement('user'));
        $arrayExperienceTitle = $_POST['titleExperience'];
        $arrayStartDay = $_POST['startDate'];
        $arrayEndDay = $_POST['endDate'];
        $arrayPlaceID= $_POST['place'];
        $arrayDescription = $_POST['description'];
        $ExpList = array();
        for ($i = 0; $i < count($arrayExperienceTitle); $i++){
            $Etitle = $arrayExperienceTitle[$i];
            $EstartDate = $arrayStartDay[$i];
            $EfinishDate = $arrayEndDay[$i];
            $Edescriprion = $arrayDescription[$i];
            $EplaceID = $arrayPlaceID[$i];
            $Eplace = $pm->load("IDplace", $EplaceID, FPlace::getClass());
            $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
            $exp->setPlaceID($EplaceID);
            $ExpList[] = $exp;
        }
        $title = $_POST['title'];
        $TravelDays = FTravel::lowerAndHigherDate($ExpList);
        $DayOne = $TravelDays[0];
        $LastDay = $TravelDays[1];
        $travel = new ETravel(0, $title, $ExpList, array(), $DayOne, $LastDay);
        $date = date("Y-m-d h:i:s");
        $userID = $user->getUserID();
        $deleted = 0;
        $post = new EPost($title, array(), array(), $date, $travel, $deleted, array(), array(), $userID);
        $postID = $pm->store($post);
        $travel->setPostID($postID);
        $travelID = $pm->store($travel);
        foreach ($ExpList as $exp){
            $exp->setTravelID($travelID);
            $pm->store($exp);

            if ($pm->existAssociationUserPlace($userID,$exp->getPlaceID()) == false){
                $pm->storePlaceToUser($userID, $exp->getPlaceID());
            }
            if ($pm->existAssociationPostPlace($postID,$exp->getPlaceID()) == false){
                $pm->storePlaceToPost($postID, $exp->getPlaceID());
            }
        }

        for($numImg=2; isset($_FILES['image'.$numImg]);$numImg++){
            $nome_file = 'image' . $numImg;
            $img = static::upload($travelID, $nome_file);
            switch ($img) {
                case "size":
                    //$view->registrationError("size");
                    break;
                case "type":
                    //$view->registrationError("type");
                    break;
                case "ok":
                    header('Location: /logBook/User/profile');
                    break;
            }
        }

        header('Location: /logBook/User/profile');
    }

    public static function create_post(){
        $view = new VPost();
        $pm = FPersistentManager::getInstance();
        $arrayMete = $pm->load('category', 'meta turistica', FPlace::getClass());
        $arrayCity = $pm->load('category', 'città', FPlace::getClass());
        $arrayRegions = $pm->load('category', 'regione', FPlace::getClass());
        $arrayState = $pm->load('category', 'nazione', FPlace::getClass());
        $arrayPlace=$pm->loadAll(FPlace::getClass());
        $view->create_post($arrayPlace, $arrayCity, $arrayRegions, $arrayState, $arrayMete);
    }


    public static function deletePost($postID){
        USession::getInstance();
        $pm = FPersistentManager::getInstance();
        $user = unserialize(USession::getElement('user'));
        if ($user->getUserID() == $pm->getUserByPost($postID)) {
            $post = $pm->load('IDpost', $postID, FPost::getClass());
            $travel = $post->getTravel();
            $ExpList = $travel->getExperienceList();
            foreach ($ExpList as $exp) {
                $pm->delete('IDexperience', $exp->getExperienceID(), FExperience::getClass());
            }
            $pm->delete('IDtravel', $travel->getTravelID(), FTravel::getClass());
            $pm->deletePost($postID);
            header('Location: /logBook/User/profile');
        } else{
            header('Location: /logBook/User/home');
        }
    }


    public static function reportPost($id){
        $view = new VResearch();
        FPersistentManager::reportPost($id);
        $view->search_result();
    }


    static function upload($travelID,$nome_file) {
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
            $image= new EImage($immagine,$travelID,$size,$type);
            $pm->storeMedia($image,$nome_file);
            $ris = "ok";
        }
        else {
            //formato diverso
            $ris = "type";
        }

        return $ris;
    }


    /**
     * @throws SmartyException
     */
    static function modify_post($postID){
        USession::getInstance();
        $view = new VPost();
        $pm = FPersistentManager::getInstance();
        $user = unserialize(USession::getElement('user'));
        if ($user->getUserID() == $pm->getUserByPost($postID)) {
            $travel = $pm->loadTravelByPost($postID);
            $image = $pm->load("IDtravel", $travel->getTravelID(), FImage::getClass());
            $arrayExperience = $travel->getExperienceList();
            $numero = 2;
            $arrayMete = $pm->load('category', 'meta turistica', FPlace::getClass());
            $arrayCity = $pm->load('category', 'città', FPlace::getClass());
            $arrayRegions = $pm->load('category', 'regione', FPlace::getClass());
            $arrayState = $pm->load('category', 'nazione', FPlace::getClass());
            $arrayPlace = $pm->loadAll(FPlace::getClass());
            $view->modify_post($travel, $arrayExperience, $numero, $arrayPlace, $postID, $image, $arrayCity, $arrayRegions, $arrayState, $arrayMete);
        } else{
            header('Location: /logBook/User/home');
        }
    }


    static function updatePost($postID){
        $pm = FPersistentManager::getInstance();
        $user = $pm->loadUserByPost($postID);
        $travel = $pm->loadTravelByPost($postID);
        $arrayOriginalExperience = $travel->getExperienceList();

        $arrayExperienceTitle = $_POST['titleExperience'];
        $arrayStartDay = $_POST['startDate'];
        $arrayEndDay = $_POST['endDate'];
        $arrayPlace = $_POST['place'];
        $arrayDescription = $_POST['description'];

        for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
            foreach ($arrayOriginalExperience as $expO) {
                $pm->delete('IDexperience', $expO->getExperienceID(), FExperience::getClass());
            }
        }

        $ExpList = array();
        for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
            $Etitle = $arrayExperienceTitle[$i];
            $EstartDate = $arrayStartDay[$i];
            $EfinishDate = $arrayEndDay[$i];
            $Edescriprion = $arrayDescription[$i];
            $EplaceID = $arrayPlace[$i];
            $Eplace = $pm->load("IDplace", $EplaceID, FPlace::getClass());
            $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
            $exp->setPlaceID($EplaceID);
            $ExpList[] = $exp;
        }

        $travelID = $travel->getTravelID();
        foreach ($ExpList as $exp) {
            $exp->setTravelID($travelID);
            $pm->store($exp);

            if ($pm->existAssociationUserPlace($user->getUserID(), $exp->getPlaceID()) == false) {
                $pm->storePlaceToUser($user->getUserID(), $exp->getPlaceID());
            }
            if ($pm->existAssociationPostPlace($postID, $exp->getPlaceID()) == false) {
                $pm->storePlaceToPost($postID, $exp->getPlaceID());
            }
        }

        header('Location: /logBook/User/profile');
    }

    static function writeComment($IDpost){
        USession::getInstance();
        $user=unserialize(USession::getElement('user'));
        $content=$_POST['comment'];
        $comment= new EComment( $IDpost, $user,null ,null ,$content );
        $pm= FPersistentManager::getInstance();
        $pm->store($comment);
        header('Location: /logBook/Research/postDetail/'.$IDpost);
    }
}