<?php

require 'utility/UCookie.php';
require 'utility/USession.php';
require 'utility/UServer.php';

class CPost{
    public static function savePost(){
        /*
         * N1 per quale cazzo di motivo non funziona la session?
         * N2 come faccio a mettere un counter sul click di new exp ed usare quel numero in php?
         * N3 stessa cosa con IMG
         *
         */

        USession::getInstance();
        $user = unserialize(USession::getElement('user'));
        $view = new VPost();
        $pm = new FPersistentManager();
        $title = $_POST['titleExperience2'];
        $date = date("Y-m-d h:i:s" );
        $deleted = 0;
        $userID = $user->getUserID();

        $startDate = $_POST['startDate2'];
        $finishDate = $_POST['endDate2'];
        $travel = new ETravel(9, $title, array(), array(), $startDate, $finishDate);
        $post = new EPost($title, array(), array(), $date, $travel, $deleted, array(), array(), $userID);
        //$img = $_FILES['file'];
        $cosa = $_POST['titleExperience2'];
        echo var_dump($post);
        $pm->store($post);
        $pm->store($travel);
        //$view->savePost($cosa);
    }

    public static function create_post(){
        $view = new VPost();
        //$creatorId = USession::getElement('IDuser');
        //$creatorUsername = USession::getElement('username');
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
}