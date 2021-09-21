<?php


class EImage
{
    private $imageID;

    private $imageFile;

    private $travelID;

    private $size;

    private $type;

    /**
     * EImage constructor.
     * @param $imageID
     * @param $url
     */
    public function __construct($imageFile, $travelID, $size, $type)
    {

        $this->imageFile = $imageFile;
        $this->travelID=$travelID;
        $this->size=$size;
        $this->type=$type;

    }

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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getImageID()
    {
        return $this->imageID;
    }

    /**
     * @param mixed $imageID
     */
    public function setImageID($imageID): void
    {
        $this->imageID = $imageID;
    }


    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $url
     */
    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;
    }

}