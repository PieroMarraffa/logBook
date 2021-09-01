<?php


class EAdmin extends EUser
{
    private $signaledPosts;
    private $deletedPosts;
    private $deletedComments;
    private $signaledComments;

    //--------------------COSTRUTTORE----------------

    public function __construct($userID, $userName, $name, $password, $mail, $imgPathFile, $description){
        parent::__construct($userID, $userName, $name, $password, $mail, $imgPathFile, $description);
        $this->signaledPosts = array();
        $this->deletedPosts = array();
        $this->deletedComments = array();
        $this->signaledComments = array();
    }

    /**
     * @return mixed
     */
    public function getSignaledPosts()
    {
        return $this->signaledPosts;
    }

    /**
     * @param mixed $signaledPosts
     */
    public function setSignaledPosts($signaledPosts): void
    {
        $this->signaledPosts = $signaledPosts;
    }

    /**
     * @return mixed
     */
    public function getDeletedPosts()
    {
        return $this->deletedPosts;
    }

    /**
     * @param mixed $deletedPosts
     */
    public function setDeletedPosts($deletedPosts): void
    {
        $this->deletedPosts = $deletedPosts;
    }

    /**
     * @return mixed
     */
    public function getDeletedComments()
    {
        return $this->deletedComments;
    }

    /**
     * @param mixed $deletedComments
     */
    public function setDeletedComments($deletedComments): void
    {
        $this->deletedComments = $deletedComments;
    }

    /**
     * @return mixed
     */
    public function getSignaledComments()
    {
        return $this->signaledComments;
    }

    /**
     * @param mixed $signaledComments
     */
    public function setSignaledComments($signaledComments): void
    {
        $this->signaledComments = $signaledComments;
    }


    //--------------METODI ADD TO LIST----------------------

    public function addPostToReported(EPost $post){
        array_push($this->signaledPosts, $post);
    }

    public function removePostFromReported($pos){
        unset($this->signaledPosts[$pos]);
        $this->signaledPosts = array_values($this->signaledPosts);
    }

    public function addPostToDeleted(EPost $post){
        array_push($this->deletedPosts, $post);
    }

    public function removePostFromDeleted($pos){
        unset($this->deletedPosts[$pos]);
        $this->deletedPosts = array_values($this->deletedPosts);
    }

    public function addCommentToReported(EComment $comment){
        array_push($this->signaledComments, $comment);
    }

    public function removeCommentFromReported($pos){
        unset($this->signaledComments[$pos]);
        $this->signaledComments = array_values($this->signaledComments);
    }

    public function addCommentToDeleted(EComment $comment){
        array_push($this->deletedComments, $comment);
    }

    public function removeCommentFromDeleted($pos){
        unset($this->deletedComments[$pos]);
        $this->deletedComments = array_values($this->deletedComments);
    }
}