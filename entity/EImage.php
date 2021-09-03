<?php


class EImage
{
    private $imageID;

    private $url;

    /**
     * EImage constructor.
     * @param $imageID
     * @param $url
     */
    public function __construct($imageID, $url)
    {
        $this->imageID = $imageID;
        $this->url = $url;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

}