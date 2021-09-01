<?php


use Cassandra\Date;

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


    //--------------COSTRUTTORE----------------------


    /**
     * EExperience constructor.
     * @param $experienceID
     * @param $startDay
     * @param $endDay
     * @param $title
     * @param $description
     */

    public function __construct($experienceID, $startDay, $endDay, $title, $description)
    {
        $this->experienceID = $experienceID;
        $this->startDay = new Date($startDay);
        $this->endDay = new Date($endDay);
        $this->title = $title;
        $this->placeList = array();
        $this->description = $description;
        $this->imageList = array();
        $this->experienceList = array();
    }

    //--------------METODI GETTER E SETTER----------------------


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


    //--------------METODI ADD TO LIST----------------------

    public function addPlace(EPlace $place){
        array_push($this->placeList, $place);
    }

    public function removePlace($pos){
        unset($this->placeList[$pos]);
        $this->placeList = array_values($this->placeList);
    }

    public function addExperience(EExperience $experience){
        array_push($this->experienceList, $experience);
    }

    public function removeExperience($pos){
        unset($this->experienceList[$pos]);
        $this->experienceList = array_values($this->experienceList);
    }

    public function addImg(String $url){
        array_push($this->imageList, $url);
    }

    public function removeImg($pos){
        unset($this->imageList[$pos]);
        $this->imageList = array_values($this->imageList);
    }



    }