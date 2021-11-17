<?php


use Cassandra\Date;

class EExperience
{
    private $experienceID;
    private $travelID;
    private $startDay;
    private $endDay;
    private $title;
    private $place;
    private $description;


    //--------------COSTRUTTORE----------------------


    /**
     * EExperience constructor.
     * @param $travelID
     * @param $startDay
     * @param $endDay
     * @param $title
     * @param $place
     * @param $description
     */

    public function __construct($travelID, $startDay, $endDay, $title, EPlace $place, $description)
    {
        $this->travelID=$travelID;
        $this->startDay = $startDay;
        $this->endDay = $endDay;
        $this->title = $title;
        $this->place = new EPlace($place->getLatitude(), $place->getLongitude(), $place->getName(), $place->getCountryName());
        $this->description = $description;
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
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
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




    //--------------METODI ADD TO LIST----------------------

    public function addPlace(EPlace $place){
        array_push($this->place, $place);
    }

    public function removePlace($pos){
        unset($this->place[$pos]);
        $this->place = array_values($this->place);
    }

    public function getPlaceID(){
        return $this->place->getPlaceID();
    }

    public function setPlaceID($id){
        $this->place->setPlaceID($id);
    }

    }