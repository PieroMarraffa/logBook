<?php


class ELike
{
    private $value;

    private $userID;

    private $likeID;

    private $postID;


    /**
     * ELike constructor.
     * @param $value
     * @param $userID
     * @param $likeID
     */

    public function __construct($value, $userID,$postID)
    {
        $this->value = $value;
        $this->userID = $userID;
        $this->postID= $postID;
    }

    /**
     * @return mixed
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * @param mixed $postID
     */
    public function setPostID($postID): void
    {
        $this->postID = $postID;
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
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
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