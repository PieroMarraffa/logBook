<?php


class Page
{
    private $id;

    private $startDay;

    private $endDay;

    private $title;

    private $descrition;

    private $imageList;

    private $metaList;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setStartDay($startDay)
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
    public function setEndDay($endDay)
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
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescrition()
    {
        return $this->descrition;
    }

    /**
     * @param mixed $descrition
     */
    public function setDescrition($descrition)
    {
        $this->descrition = $descrition;
    }

    /**
     * @return mixed
     */
    public function getImageList()
    {
        return $this->imageList;
    }

    /**
     * @param mixed $imageList
     */
    public function setImageList($imageList)
    {
        $this->imageList = $imageList;
    }

    /**
     * @return mixed
     */
    public function getMetaList()
    {
        return $this->metaList;
    }

    /**
     * @param mixed $metaList
     */
    public function setMetaList($metaList)
    {
        $this->metaList = $metaList;
    }
}