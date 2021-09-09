<?php


class EAdmin
{
    private $userName;
    private $password;
    private $mail;
    private $deletedPosts;
    private $deletedComments;

    //--------------------COSTRUTTORE----------------

    /**
     * EAdmin constructor.
     * @param $userName
     * @param $password
     * @param $mail
     * @param $signaledPosts
     * @param $deletedPosts
     * @param $deletedComments
     * @param $signaledComments
     */
    public function __construct($userName, $password, $mail, $deletedPosts, $deletedComments)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->mail = $mail;
        $this->deletedPosts = $deletedPosts;
        $this->deletedComments = $deletedComments;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
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



    //--------------METODI ADD TO LIST----------------------





    public function addPostToDeleted(EPost $post){
        array_push($this->deletedPosts, $post);
    }

    public function removePostFromDeleted($pos){
        unset($this->deletedPosts[$pos]);
        $this->deletedPosts = array_values($this->deletedPosts);
    }


    public function addCommentToDeleted(EComment $comment){
        array_push($this->deletedComments, $comment);
    }

    public function removeCommentFromDeleted($pos){
        unset($this->deletedComments[$pos]);
        $this->deletedComments = array_values($this->deletedComments);
    }
}