<?php


class EImage
{
    private $imageID;

    private $imageFile;

    private $width;

    private $height;

    /**
     * EImage constructor.
     * @param $imageID
     * @param $url
     */
    public function __construct($imageID, $imageFile,$width,$height)
    {
        $this->imageID = $imageID;
        $this->imageFile = $imageFile;
        $this->width=$width;
        $this->height=$height;

    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
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