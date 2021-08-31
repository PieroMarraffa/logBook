<?php


class EExperience
{
    private $experienceID;
    private $startDay;
    private $endDay;
    private $title;
    private $placeList;
    private $description;
    private $imageList;
    private $experienceList;

    /**
     * EExperience constructor.
     * @param $experienceID
     * @param $startDay
     * @param $endDay
     * @param $title
     * @param $placeList
     * @param $description
     * @param $imageList
     * @param $experienceList
     */

    public function __construct($experienceID, $startDay, $endDay, $title, $placeList, $description, $imageList, $experienceList)
    {
        $this->experienceID = $experienceID;
        $this->startDay = $startDay;
        $this->endDay = $endDay;
        $this->title = $title;
        $this->placeList = $placeList;
        $this->description = $description;
        $this->imageList = $imageList;
        $this->experienceList = $experienceList;
    }

    /**
     * @return mixed
     */
    public function getExperienceID()
    {
        return $this->experienceID;
    }

    /**
     * @param mixed $experienceID
     */
    public function setExperienceID($experienceID): void
    {
        $this->experienceID = $experienceID;
    }

    /**
     * @return mixed
     */
    public function getStartDay()
    {
        return $this->startDay;
    }

    /**
     * @param mixed $startDay
     */
    public function setStartDay($startDay): void
    {
        $this->startDay = $startDay;
    }

    /**
     * @return mixed
     */
    public function getEndDay()
    {
        return $this->endDay;
    }

    /**
     * @param mixed $endDay
     */
    public function setEndDay($endDay): void
    {
        $this->endDay = $endDay;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPlaceList()
    {
        return $this->placeList;
    }

    /**
     * @param mixed $placeList
     */
    public function setPlaceList($placeList): void
    {
        $this->placeList = $placeList;
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
    public function getImageList()
    {
        return $this->imageList;
    }

    /**
     * @param mixed $imageList
     */
    public function setImageList($imageList): void
    {
        $this->imageList = $imageList;
    }

    /**
     * @return mixed
     */
    public function getExperienceList()
    {
        return $this->experienceList;
    }

    /**
     * @param mixed $experienceList
     */
    public function setExperienceList($experienceList): void
    {
        $this->experienceList = $experienceList;
    }

    }