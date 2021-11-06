<?php


class ETravel
{
    private $travelID;
    private $postID;
    private $title;
    private $imageList;
    private $experienceList;
    private $startDate;
    private $finishDate;

    //--------------------COSTRUTTORE----------------

    /**
     * EAdmin constructor.
     * @param $travelID
     * @param $postID
     * @param $title
     * @param $experienceList
     * @param $startDate
     * @param $finishDate
     * @throws Exception
     */
    public function __construct( $postID,$title, $experienceList, $startDate, $finishDate)
    {
        $this->postID = $postID;
        $this->title=$title;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
        $this->experienceList = $experienceList;
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

    //--------------METODI GETTER E SETTER----------------------

    /**
     * @return mixed
     */
    public function getTravelID()
    {
        return $this->travelID;
    }

    /**
     * @param mixed $travelID
     */
    public function setTravelID($travelID)
    {
        $this->travelID = $travelID;
    }

    /**
     * @return mixed
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * @param mixed $postID
     */
    public function setPostID($postID): void
    {
        $this->postID = $postID;
    }

    /**
     * @return array
     */
    public function getExperienceList()
    {
        return $this->experienceList;
    }

    /**
     * @param array $experienceList
     */
    public function setExperienceList(array $experienceList): void
    {
        $this->experienceList = $experienceList;
    }

    /**
     * @return $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return $finishDate
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param $finishDate
     */
    public function setFinishDate($finishDate): void
    {
        $this->finishDate = $finishDate;
    }

//--------------METODI ADD TO LIST----------------------

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