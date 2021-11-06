<?php


class CPost{
    /**
     * @throws Exception
     */
    public static function savePost()
    {
        if(CUser::isLogged()) {
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            $user = unserialize(USession::getElement('user'));
            if (!isset($_POST['titleExperience'])) {
                header('Location: /logBook/User/profile');
            } else {
                $arrayExperienceTitle = $_POST['titleExperience'];
                $arrayStartDay = $_POST['startDate'];
                $arrayEndDay = $_POST['endDate'];
                $arrayPlaceID = $_POST['place'];
                $arrayDescription = $_POST['description'];
                $ExpList = array();
                for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
                    $Etitle = $arrayExperienceTitle[$i];
                    $EstartDate = $arrayStartDay[$i];
                    $EfinishDate = $arrayEndDay[$i];
                    $Edescriprion = $arrayDescription[$i];
                    $EplaceID = $arrayPlaceID[$i];
                    $Eplace = $pm->load("IDplace", $EplaceID, FPlace::getClass());
                    if ($Etitle != '' && $EstartDate != '' && $EfinishDate != '' && $Edescriprion != '') {
                        $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
                        $exp->setPlaceID($EplaceID);
                        $ExpList[] = $exp;
                    }

                }
                if (count($ExpList) == 0) {
                    header('Location: /logBook/User/profile');
                } else {
                    $title = $_POST['title'];
                    $TravelDays = FTravel::lowerAndHigherDate($ExpList);
                    $DayOne = $TravelDays[0];
                    $LastDay = $TravelDays[1];
                    $travel = new ETravel(0, $title, $ExpList, $DayOne, $LastDay);
                    $date = date("Y-m-d h:i:s");
                    $userID = $user->getUserID();
                    $deleted = 0;
                    $post = new EPost( array(), array(), $date, $travel, $deleted, array(), array(), $userID);
                    $postID = $pm->store($post);
                    $travel->setPostID($postID);
                    $travelID = $pm->store($travel);
                    foreach ($ExpList as $exp) {
                        $exp->setTravelID($travelID);
                        $pm->store($exp);

                        echo var_dump($pm->existAssociationUserPlace($userID, $exp->getPlaceID()));
                        if ($pm->existAssociationUserPlace($userID, $exp->getPlaceID()) == false) {
                            $pm->storePlaceToUser($userID, $exp->getPlaceID());
                        }
                        echo var_dump($pm->existAssociationPostPlace($postID, $exp->getPlaceID()));
                        if ($pm->existAssociationPostPlace($postID, $exp->getPlaceID()) == false) {
                            $pm->storePlaceToPost($postID, $exp->getPlaceID());
                        }
                    }

                    for ($numImg = 2; isset($_FILES['image' . $numImg]); $numImg++) {
                        echo $numImg;
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
                                //header('Location: /logBook/User/profile');
                                break;
                        }
                    }

                    header('Location: /logBook/User/profile');
                }
            }
        } else{
            header('Location: /logBook/User/home');
        }
    }

    /**
     * @throws SmartyException
     */
    public static function create_post(){
        if(CUser::isLogged()) {
            $view = new VPost();
            $pm = FPersistentManager::getInstance();
            $arrayMete = $pm->load('category', 'meta turistica', FPlace::getClass());
            $arrayCity = $pm->load('category', 'città', FPlace::getClass());
            $arrayRegions = $pm->load('category', 'regione', FPlace::getClass());
            $arrayState = $pm->load('category', 'nazione', FPlace::getClass());
            $arrayPlace=$pm->loadAll(FPlace::getClass());
            $view->create_post($arrayPlace, $arrayCity, $arrayRegions, $arrayState, $arrayMete);
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

                $travel = $pm->load('IDpost', $postID, FTravel::getClass());

                $listaPlaceID = $pm->loadAllPlaceIDByUser($user->getUserID());
                $pm->deleteAllFromPlaceToUser($user->getUserID());
                foreach ($listaPlaceID as $id){
                    $pm->storePlaceToUser($user->getUserID(), $id);
                }

                $pm->deleteFromPlaceToPost($postID);
                $pm->deleteFromPostReported($postID);
                $pm->deleteFromReaction($postID);
                $pm->delete('IDpost', $postID, FComment::getClass());
                $pm->delete('IDtravel', $travel->getTravelID(), FExperience::getClass());
                $pm->delete('IDtravel', $travel->getTravelID(), FImage::getClass());
                $pm->delete('IDpost', $postID, FPost::getClass());

                header('Location: /logBook/User/profile');
            } else{
                header('Location: /logBook/User/home');
            }
        }else{
            header('Location: /logBook/User/login');
        }
    }

    public static function deleteExistingExperience($id, $postID){
        $pm = FPersistentManager::getInstance();
        $pm->update('IDexperience', -$id, $id, FExperience::getClass());
        self::modify_post($postID);
    }


    /**
     * @throws SmartyException
     */
    public static function deleteExistingImage($id, $postID){
        $pm = FPersistentManager::getInstance();
        $pm->update('IDimage', -$id, $id, FImage::getClass());
        self::modify_post($postID);
    }


    public static function reportPost($id){
        $view = new VResearch();
        FPersistentManager::reportPost($id);
        $view->search_result();
    }


    /**
     * @throws SmartyException
     */
    static function upload($travelID, $nome_file) {
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
                $image= new EImage($immagine,$travelID,$size,$type);
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
                $travel = $pm->loadTravelByPost($postID);
                $image = $pm->load("IDtravel", $travel->getTravelID(), FImage::getClass());
                $arrayExperience = $travel->getExperienceList();
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
                $arrayMete = $pm->load('category', 'meta turistica', FPlace::getClass());
                $arrayCity = $pm->load('category', 'città', FPlace::getClass());
                $arrayRegions = $pm->load('category', 'regione', FPlace::getClass());
                $arrayState = $pm->load('category', 'nazione', FPlace::getClass());
                $arrayPlace = $pm->loadAll(FPlace::getClass());
                $view->modify_post($travel, $arrayExperienceDaVedere, $numero, $arrayPlace, $postID, $imageDaVedere, $arrayCity, $arrayRegions, $arrayState, $arrayMete);
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
                $travel = $pm->loadTravelByPost($postID);
                $image = $pm->load("IDtravel", $travel->getTravelID(), FImage::getClass());
                $arrayExperience = $travel->getExperienceList();
                foreach ($arrayExperience as $exp) {
                    if ($exp->getExperienceID() < 0) {
                        $pm->update('IDexperience', -$exp->getExperienceID(), $exp->getExperienceID(), FExperience::getClass());
                    }
                }
                foreach ($image as $i){
                    if ($i->getImageID < 0){
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
    static function updatePost($postID){
        if(CUser::isLogged()) {
            $pm = FPersistentManager::getInstance();
            $user = $pm->loadUserByPost($postID);
            $travel = $pm->loadTravelByPost($postID);
            $arrayOriginalExperience = $travel->getExperienceList();

            if (isset($_POST['titleExperience']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['description']) && isset($_POST['title'])) {
                $titlePost = $_POST['title'];
                $pm->update('Title', $titlePost, $postID, FPost::getClass());
                $pm->update('Title', $titlePost, $travel->getTravelID(), FTravel::getClass());
                $arrayExperienceTitle = $_POST['titleExperience'];
                $arrayStartDay = $_POST['startDate'];
                $arrayEndDay = $_POST['endDate'];
                $arrayPlaceID = $_POST['place'];
                $arrayDescription = $_POST['description'];

                foreach ($arrayOriginalExperience as $expO) {
                    $deletableAssociation = true;
                    foreach ($arrayPlaceID as $id) {
                        if ($id == $expO->getPlaceID()) {
                            $deletableAssociation = false;
                        }
                    }
                    if ($deletableAssociation == true) {
                        $pm->deleteOneFromPlaceToPost($postID, $expO->getPlaceID());
                    }
                    $pm->delete('IDexperience', $expO->getExperienceID(), FExperience::getClass());
                }

                $ExpList = array();
                for ($i = 0; $i < count($arrayExperienceTitle); $i++) {
                    $Etitle = $arrayExperienceTitle[$i];
                    $EstartDate = $arrayStartDay[$i];
                    $EfinishDate = $arrayEndDay[$i];
                    $Edescriprion = $arrayDescription[$i];
                    $EplaceID = $arrayPlaceID[$i];
                    $Eplace = $pm->load("IDplace", $EplaceID, FPlace::getClass());
                    if ($Etitle != '' && $EstartDate != '' && $EfinishDate != '' && $Edescriprion != '') {
                        $exp = new EExperience(0, $EstartDate, $EfinishDate, $Etitle, $Eplace, $Edescriprion);
                        $exp->setPlaceID($EplaceID);
                        $ExpList[] = $exp;
                    }
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

                $listaPlaceID = $pm->loadAllPlaceIDByUser($user->getUserID());
                $pm->deleteAllFromPlaceToUser($user->getUserID());
                foreach ($listaPlaceID as $id) {
                    $pm->storePlaceToUser($user->getUserID(), $id);
                }

            }

            header('Location: /logBook/User/profile');
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     */
    static function writeComment($IDpost){
        if(CUser::isLogged()) {
            USession::getInstance();
            $user = unserialize(USession::getElement('user'));
            $content = $_POST['comment'];
            $comment = new EComment($IDpost, $user, null, $content);
            $pm = FPersistentManager::getInstance();
            $pm->store($comment);
            header('Location: /logBook/Research/postDetail/' . $IDpost);
        }else{
            header('Location: /logBook/User/login');
        }
    }


    /**
     * @throws SmartyException
     */
    static function like($IDpost,$value)
    {
        if (CUser::isLogged()) {
            USession::getInstance();
            $user = unserialize(USession::getElement('user'));
            if ($value == 1 || $value == -1) {
                $reaction = new ELike($value, $user, $IDpost);
                $pm = FPersistentManager::getInstance();
                var_dump($user);
                $result = $pm->load('IDuser', $user->getUserID(), FLike::getClass());
                var_dump($result);
                if ($result == null) {
                    $pm->store($reaction);
                    header('Location: /logBook/Research/postDetail/' . $IDpost);
                } else {
                    if(is_object($result)){
                        $pm->store($reaction);
                        header('Location: /logBook/Research/postDetail/' . $IDpost);
                    }else {
                        $exist=false;
                        foreach ($result as $res) {
                            if ($res->getPostID() == $IDpost) {
                                $exist=true;
                                break;
                            }
                        }
                        if($exist!=true){
                            $pm->store($reaction);
                        }
                        header('Location: /logBook/Research/postDetail/' . $IDpost);

                    }
                    }
                }
            else{
                    header('Location: /logBook/Research/postDetail/' . $IDpost);
                }

        } else{
            header('Location: /logBook/Research/postDetail/' . $IDpost);
        }
    }



}
