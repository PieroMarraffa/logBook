<?php


class CPost{
    public static function savePost(){
        //USession::getInstance();
        //$user = unserialize(USession::getElement('user'));
        $view = new VPost();
        $pm = new FPersistentManager();
        $title = $_POST['titleExperience2'];
        $date = date("Y-m-d h:i:s" );
        $deleted = 0;
        $userID = 1;
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