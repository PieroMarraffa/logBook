<?php


class EImage
{
    private $imageID;

    private $category;

    private $url;

    /**
     * EImage constructor.
     * @param $imageID
     * @param $category
     * @param $url
     */
    public function __construct($imageID, $category, $url)
    {
        $this->imageID = $imageID;
        $this->category = $category;
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