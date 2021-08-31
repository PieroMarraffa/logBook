<?php


class EPost
{
    private $author;
    private $title;
    private $commentList;
    private $likeList;
    private $creationDate;
    private $experience;
    private $postID;

    /**
     * EPost constructor.
     * @param $author
     * @param $title
     * @param $commentList
     * @param $likeList
     * @param $creationDate
     * @param $experience
     * @param $postID
     */
    public function __construct($author, $title, $commentList, $likeList, $creationDate, $experience, $postID)
    {
        $this->author = $author;
        $this->title = $title;
        $this->commentList = $commentList;
        $this->likeList = $likeList;
        $this->creationDate = $creationDate;
        $this->experience = $experience;
        $this->postID = $postID;
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
    public function setAuthor($author)
    {
        $this->author = $author;
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
    public function getCommentList()
    {
        return $this->commentList;
    }

    /**
     * @param mixed $commentList
     */
    public function setCommentList($commentList)
    {
        $this->commentList = $commentList;
    }

    /**
     * @return mixed
     */
    public function getLikeList()
    {
        return $this->likeList;
    }

    /**
     * @param mixed $likeList
     */
    public function setLikeList($likeList)
    {
        $this->likeList = $likeList;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
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
    public function setPostID($postID)
    {
        $this->postID = $postID;
    }


}