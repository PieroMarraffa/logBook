<?php


class EUser
{
    private $userID;
    private $userName;
    private $name;
    private $password;
    private $mail;
    private $imgPathFile;
    private $description;
    private $likedPosts;
    private $personalPosts;
    private $visitedPlaces;
    private $banned;

    /**
     * EUser constructor.
     * @param $userID
     * @param $userName
     * @param $name
     * @param $password
     * @param $mail
     * @param $imgPathFile
     * @param $description
     * @param $banned
     */
    public function __construct($IDuser, $email, $password, $name, $description, $image, $username, $banned)
    {
        $this->userID = $IDuser;
        $this->userName = $username;
        $this->name = $name;
        $this->password = $password;
        $this->mail = $email;
        $this->imgPathFile = $image;
        $this->description = $description;
        $this->likedPosts = array();
        $this->personalPosts = array();
        $this->visitedPlaces = array();
        $this->banned = $banned;
    }


    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
    public function getImgPathFile()
    {
        return $this->imgPathFile;
    }

    /**
     * @param mixed $imgPathFile
     */
    public function setImgPathFile($imgPathFile): void
    {
        $this->imgPathFile = $imgPathFile;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLikedPosts()
    {
        return $this->likedPosts;
    }

    /**
     * @param mixed $likedPosts
     */
    public function setLikedPosts($likedPosts): void
    {
        $this->likedPosts = $likedPosts;
    }

    /**
     * @return mixed
     */
    public function getPersonalPosts()
    {
        return $this->personalPosts;
    }

    /**
     * @param mixed $personalPosts
     */
    public function setPersonalPosts($personalPosts): void
    {
        $this->personalPosts = $personalPosts;
    }

    /**
     * @return mixed
     */
    public function getVisitedPlaces()
    {
        return $this->visitedPlaces;
    }

    /**
     * @param mixed $visitedPlaces
     */
    public function setVisitedPlaces($visitedPlaces): void
    {
        $this->visitedPlaces = $visitedPlaces;
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned;
    }

    /**
     * @param bool $banned
     */
    public function setBanned(bool $banned): void
    {
        $this->banned = $banned;
    }


    //--------------METODI ADD TO LIST----------------------

    public function addPostToLiked(EPost $post){
        array_push($this->likedPosts, $post);
    }

    public function removePostFromLiked($pos){
        unset($this->likedPosts[$pos]);
        $this->placeList = array_values($this->likedPosts);
    }

    public function addPost(EPost $post){
        array_push($this->personalPosts, $post);
    }

    public function removePost($pos){
        unset($this->personalPosts[$pos]);
        $this->personalPosts = array_values($this->personalPosts);
    }

    public function addPlace(EPlace $place){
        array_push($this->visitedPlaces, $place);
    }

    public function removePlace($pos){
        unset($this->visitedPlaces[$pos]);
        $this->visitedPlaces = array_values($this->visitedPlaces);
    }


}