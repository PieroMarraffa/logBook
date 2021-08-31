<?php


class EProfile
{
    private $utentName;
    private $imgPathFile;
    private $description;
    private $likedPosts;
    private $personalPosts;
    private $visitedPlaces;
    private $profileID;

    /**
     * EProfile constructor.
     * @param $utentName
     * @param $imgPathFile
     * @param $description
     * @param $likedPosts
     * @param $personalPosts
     * @param $visitedPlaces
     * @param $profileID
     */
    public function __construct($utentName, $imgPathFile, $description, $likedPosts, $personalPosts, $visitedPlaces, $profileID)
    {
        $this->utentName = $utentName;
        $this->imgPathFile = $imgPathFile;
        $this->description = $description;
        $this->likedPosts = $likedPosts;
        $this->personalPosts = $personalPosts;
        $this->visitedPlaces = $visitedPlaces;
        $this->profileID = $profileID;
    }


    /**
     * @return mixed
     */
    public function getUtentName()
    {
        return $this->utentName;
    }

    /**
     * @param mixed $utentName
     */
    public function setUtentName($utentName)
    {
        $this->utentName = $utentName;
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