<?php


class EPlace implements Countable
{
    private $name;
    private $latitude;
    private $longitude;
    private $category;
    private $placeID;
    private $padreID;

    /**
     * EPlace constructor.
     * @param $padreID
     * @param $name
     * @param $latitude
     * @param $longitude
     * @param $category
     */
    public function __construct($padreID, $name, $latitude, $longitude,$category)
    {
        $this->padreID = $padreID;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->category=$category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
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
    public function setName($name)
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
    public function getPlaceID()
    {
        return $this->placeID;
    }

    /**
     * @param mixed $placeID
     */
    public function setPlaceID($placeID)
    {
        $this->placeID = $placeID;
    }


    public function count()
    {
        return 1;
    }

    /**
     * @return mixed
     */
    public function getPadreID()
    {
        return $this->padreID;
    }

    /**
     * @param mixed $padreID
     */
    public function setPadreID($padreID): void
    {
        $this->padreID = $padreID;
    }
}