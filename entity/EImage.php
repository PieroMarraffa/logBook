<?php


class EImage
{
    private $imageID;

    private $imageFile;

    private $postID;

    private $size;

    private $type;

    /**
     * EImage constructor.
     * @param $imageFile
     * @param $postID
     * @param $size
     * @param $type
     */
    public function __construct($imageFile, $postID, $size, $type)
    {
        $this->imageFile = $imageFile;
        $this->postID=$postID;
        $this->size=$size;
        $this->type=$type;
    }

    /**
     * @return mixed
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * @param mixed $travelID
     */
    public function setPostID($postID): void
    {
        $this->postID = $postID;
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