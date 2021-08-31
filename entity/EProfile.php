<?php


class EProfile
{
    private $userName;
    private $imgPathFile;
    private $description;
    private $likedPosts;
    private $personalPosts;
    private $visitedPlaces;
    private $profileID;

    /**
     * EProfile constructor.
     * @param $userName
     * @param $imgPathFile
     * @param $description
     * @param $personalPosts
     * @param $profileID
     */
    public function __construct($userName, $imgPathFile, $description, $profileID)
    {
        $this->userName = $userName;
        $this->imgPathFile = $imgPathFile;
        $this->description = $description;
        $this->likedPosts = array();
        $this->personalPosts = array();
        $this->visitedPlaces = array();
        $this->profileID = $profileID;
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
    public function setUserName($userName)
    {
        $this->userName = $userName;
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
    public function setImgPathFile($imgPathFile)
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
    public function setDescription($description)
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
    public function setLikedPosts($likedPosts)
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
    public function setPersonalPosts($personalPosts)
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
    public function setVisitedPlaces($visitedPlaces)
    {
        $this->visitedPlaces = $visitedPlaces;
    }

    /**
     * @return mixed
     */
    public function getProfileID()
    {
        return $this->profileID;
    }

    /**
     * @param mixed $profileID
     */
    public function setProfileID($profileID)
    {
        $this->profileID = $profileID;
    }


}