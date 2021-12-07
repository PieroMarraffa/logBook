<?php


class EPlace implements Countable
{
    private $placeID;
    private $latitude;
    private $longitude;
    private $name;
    private $countryName;

    /**
     * EPlace constructor.
     * @param $name
     * @param $latitude
     * @param $longitude
     * @param $countryName
     */
    public function __construct($latitude, $longitude, $name, $countryName)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->name = $name;
        $this->countryName = $countryName;
    }

    /**
     * @return mixed
     */
    public function getPlaceID()
    {
        return $this->placeID;
    }

    /**
     * @param mixed $placeID
     */
    public function setPlaceID($placeID): void
    {
        $this->placeID = $placeID;
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
    public function setLatitude($latitude): void
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
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

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
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     */
    public function setCountryName($countryName): void
    {
        $this->countryName = $countryName;
    }


    public function count()
    {
        return 1;
    }
}