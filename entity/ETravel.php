<?php


class ETravel
{
    private $travelID;
    private $postID;
    private $imageList;
    private $experienceList;
    private $startDate;
    private $finishDate;

    //--------------------COSTRUTTORE----------------

    /**
     * EAdmin constructor.
     * @param $postID
     * @param $imageList
     * @param $experienceList
     * @param $startDate
     * fornire una stringa in formato yyyy-mm-dd
     * @param $finishDate
     * bisogna fornire una stringa in formato yyyy-mm-dd
     * @throws Exception
     */
    public function __construct( $postID, $experienceList, $imageList, $startDate, $finishDate)
    {
        $this->postID = $postID;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
        $this->experienceList = $experienceList;
        $this->imageList = $imageList;
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
    public function setTravelID($travelID): void
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
    public function getImageList(): array
    {
        return $this->imageList;
    }

    /**
     * @param array $imageList
     */
    public function setImageList(array $imageList): void
    {
        $this->imageList = $imageList;
    }

    /**
     * @return array $experienceList
     */
    public function getExperienceList(): array
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
     * @return DateTime
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
     * @return DateTime
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