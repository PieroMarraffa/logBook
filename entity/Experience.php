<?php


class Experience
{
    private int $experienceID;
    private \Cassandra\Date $startDay;
    private \Cassandra\Date $endDay;
    private String $title;
    private array $placeList;
    private String $description;
    private array $imageList;
    private array $experienceList;

    /**
     * @return int
     */
    public function getExperienceID(): int
    {
        return $this->experienceID;
    }

    /**
     * @param int $experienceID
     */
    public function setExperienceID(int $experienceID): void
    {
        $this->experienceID = $experienceID;
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