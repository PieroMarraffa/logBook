<?php


class CPost{
    public static function savePost()
    {
        /*
         * N3 stessa cosa con IMG
         */

        USession::getInstance();

        $num = 2;
        $view = new VPost();
        $pm = new FPersistentManager();
        $user = unserialize(USession::getElement('user'));
        $ExpList = array();
        while (isset($_POST['titleExperience' . $num])) {
            $Etitle = $_POST['titleExperience' . $num];
            $startDate = $_POST['startDate' . $num];
            $finishDate = $_POST['endDate' . $num];
            $descriprion = $_POST['description' . $num];
            $place = $pm->load("Name", "Roma", FPlace::getClass());
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

        $numImg = 0;
        echo $_FILES['file']['size'];
        $result = is_uploaded_file($_FILES['file']['tmp_name']);
        echo $result;
        if ($result) {
            $nome_file = 'image' . $numImg;
            $img = static::upload($travelID, $nome_file);
            switch ($img) {
                case "size":
                    //$view->registrationError("size");

                    break;
                case "type":
                    echo 'DIO PORCOOOOOOO';
                    //$view->registrationError("type");
                    break;
                case "ok":
                    header('Location: /logBook/User/login');
                    break;
            }
            $numImg++;
        }

        $img=$pm->load("IDimage",$user->getImageID(),'FImage');
        $arrayPost=$pm->load("IDuser",$user->getUserID(),"FPost");
        $arrayPlace=$pm->load("Category",'città',FPlace::getClass());/** RICORDATI DI MODIFICARLO (LOADPLACEBYUSER) PERCHE' SENNO' TI FA VEDERE I MARKER A CASO SULLA MAPPA*/
        $view->profile($user,$img,$arrayPost,$arrayPlace);

    }

    public static function create_post(){
        $view = new VPost();
        $view->create_post();
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
            $id=$pm->storeMedia($image,$nome_file);
            //L'inserimento è andato a buon fine, l'immagine e il nuovo user sono stati inseriti correttamente
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
        $view->modify_post($travel);
    }


    static function upgradePost(){

    }
}