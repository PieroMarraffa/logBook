<?php


class ELike
{
    private $value;
    private $author;
    private $likeID;

    /**
     * ELike constructor.
     * @param $value
     * @param $author
     * @param $likeID
     */

    public function __construct($value, $author, $likeID)
    {
        $this->value = $value;
        $this->author = $author;
        $this->likeID = $likeID;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getLikeID()
    {
        return $this->likeID;
    }

    /**
     * @param mixed $likeID
     */
    public function setLikeID($likeID): void
    {
        $this->likeID = $likeID;
    }

}