<?php


class Place
{
    private $name;

    private $latitude;

    private $longitude;

    private $nation;

    private $averageOfVisitors;

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
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * @param mixed $nation
     */
    public function setNation($nation)
    {
        $this->nation = $nation;
    }

    /**
     * @return mixed
     */
    public function getAverageOfVisitors()
    {
        return $this->averageOfVisitors;
    }

    /**
     * @param mixed $averageOfVisitors
     */
    public function setAverageOfVisitors($averageOfVisitors)
    {
        $this->averageOfVisitors = $averageOfVisitors;
    }

    /**
     * @return mixed
     */
    public function getIDLuogo()
    {
        return $this->IDLuogo;
    }

    /**
     * @param mixed $IDLuogo
     */
    public function setIDLuogo($IDLuogo)
    {
        $this->IDLuogo = $IDLuogo;
    }


}