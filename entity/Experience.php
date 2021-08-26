<?php


class Experience
{
    private $id;

    private $startDay;

    private $endDay;

    private $title;

    private $placeList;

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

    private $descrition;

    private $imageList;

    private $experienceList;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setStartDay($startDay)
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
    public function setEndDay($endDay)
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
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescrition()
    {
        return $this->descrition;
    }

    /**
     * @param mixed $descrition
     */
    public function setDescrition($descrition)
    {
        $this->descrition = $descrition;
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
    public function setImageList($imageList)
    {
        $this->imageList = $imageList;
    }


}