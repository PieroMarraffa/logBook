<?php


use Cassandra\Date;

class EPost implements Countable
{
    private $commentList;
    private $likeList;
    private $creationDate;
    private $postID;
    private $deleted;
    private $nLike;
    private $nDisLike;
    private $userID;
    private $title;
    private $experienceList;
    private $startDate;
    private $finishDate;



    /**
     * EPost constructor.
     * @param $commentList
     * @param $likeList
     * @param $creationDate
     * @param $postID
     * @param $deleted
     * @param $nLike
     * @param $nDisLike
     * @param $userID
     * @throws Exception
     */
    public function __construct($commentList, $likeList, $creationDate, $deleted, $nLike, $nDisLike, $userID,$title, $experienceList, $startDate, $finishDate)
    {

        $this->commentList = $commentList;
        $this->likeList = $likeList;
        $this->creationDate = $creationDate;
        $this->title=$title;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
        $this->experienceList = $experienceList;
        $this->deleted = $deleted;
        $this->nLike = $nLike;
        $this->nDisLike = $nDisLike;
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getExperienceList()
    {
        return $this->experienceList;
    }

    /**
     * @param mixed $experienceList
     */
    public function setExperienceList($experienceList): void
    {
        $this->experienceList = $experienceList;
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
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param mixed $finishDate
     */
    public function setFinishDate($finishDate): void
    {
        $this->finishDate = $finishDate;
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
    public function getNLike()
    {
        return $this->nLike;
    }

    /**
     * @param mixed $nLike
     */
    public function setNLike($nLike): void
    {
        $this->nLike = $nLike;
    }

    /**
     * @return mixed
     */
    public function getNDisLike()
    {
        return $this->nDisLike;
    }

    /**
     * @param mixed $nDisLike
     */
    public function setNDisLike($nDisLike): void
    {
        $this->nDisLike = $nDisLike;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
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
        $this->title=$title;
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

    /** Metodi che aggiungono e tolgono dagli array di like e commento */


    public function addCommentList(EComment $c){
        array_push($this->commentList,$c);
    }

    public function removeComment($position) {
        unset($this->commentList[$position]);
        $this->commentList=array_values($this->commentList);
    }

    public function addLikeList(ELike $l){
        array_push($this->likeList,$l);
    }

    public function removeLike($position) {
        unset($this->likeList[$position]);
        $this->LikeList=array_values($this->likeList);
    }

    public function count()
    {
        return 1;
    }
}