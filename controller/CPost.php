<?php

require 'utility/UCookie.php';
require 'utility/USession.php';
require 'utility/UServer.php';


class CPost{
    public static function savePost()
    {

        USession::getInstance();

        $num = 2;
        $view = new VUser();
        $pm = new FPersistentManager();
        $user = unserialize(USession::getElement('user'));
        $ExpList = array();
        while (isset($_POST['titleExperience' . $num])) {
            $Etitle = $_POST['titleExperience' . $num];
            $startDate = $_POST['startDate' . $num];
            $finishDate = $_POST['endDate' . $num];
            $descriprion = $_POST['description' . $num];
            $placeID = $_POST['place' . $num];
            $place = $pm->load("IDplace", $placeID, FPlace::getClass());
            $ExpList[] = new EExperience(0, $startDate, $finishDate, $Etitle, $place, $descriprion);
            $num++;
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
        }

        if ($pm->existAssociationUserPlace($userID,$place->getPlaceID()) == false){
            $pm->storePlaceToUser($userID, $place->getPlaceID());
        }
        if ($pm->existAssociationPostPlace($postID,$place->getPlaceID()) == false){
            $pm->storePlaceToPost($postID, $place->getPlaceID());
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
        $img=$pm->load("IDimage",$user->getImageID(),'FImage');
        $arrayPost=$pm->load("IDuser",$user->getUserID(),"FPost");
        $image=array();
        foreach ($arrayPost as $r){
            $t=$pm->load("IDpost",$r->getPostID(),FTravel::getClass());
            $i=$pm->load("IDtravel",$t->getTravelID(),FImage::getClass());
            $image[]=$i;
        }
        $arrayPlace=$pm->loadPlaceByUser($user->getUserID());
        $view->profile($user,$img,$arrayPost,$arrayPlace, $image);

    }

    public static function create_post(){
        $view = new VPost();
        $pm = new FPersistentManager();
        $arrayPlace=$pm->load("Category",'città',FPlace::getClass());
        $view->create_post($arrayPlace);
    }

    public static function deletePost(){
        $view = new VUser();
        $postID = USession::getElement('IDpost');
        FPersistentManager::deletePost($postID);
        $view->profile();
    }


    public static function reportPost(){
        $view = new VResearch();
        $reportedPostId = USession::getElement('IDpost');
        FPersistentManager::reportPost($reportedPostId);
        $view->search_result();
    }


    static function upload($travelID,$nome_file) {
        $pm = new FPersistentManager();
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
        $view = new VPost();
        $pm = new FPersistentManager();
        $travel = $pm->loadTravelByPost($postID);
        $arrayExperience = $travel->getExperienceList();
        $numero = 2;
        $arrayPlace=$pm->load("Category",'città',FPlace::getClass());
        $view->modify_post($travel, $arrayExperience, $numero, $arrayPlace);
    }


    static function upgradePost(){
        $pm = new FPersistentManager();
        $travel = $pm->loadTravelByPost(46);
        $arrayExperience = $travel->getExperienceList();
        $gerry = $_POST['titleExperience' . $arrayExperience[0]->getExperienceID()];
        echo var_dump($gerry);

    }
}