<?php


class CPost{
    public static function salvaPost(){
        $view = new VPost();
        $session = USession()::_instance();
        $title = USession::getElement('title');
        $img = USession::getElement('image');
        $description = USession::getElement('description');
        FPersistentManager::newPost('idpost', 'iduser', 'autore', 'titolo', 'data', 'deleted');
        $view->salvaPost($title, $img, $description);
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