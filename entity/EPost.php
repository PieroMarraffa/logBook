<?php


use Cassandra\Date;

class EPost
{
    private $title;
    private $commentList;
    private $likeList;
    private $creationDate;
    private $travel;
    private $postID;
    private $deleted;
    private $nLike;
    private $nDisLike;
    private $userID;

    /**
     * EPost constructor.
     * @param $author
     * @param $title
     * @param $commentList
     * @param $likeList
     * @param $creationDate
     * @param $travel
     * @param $postID
     * @param $deleted
     * @param $nLike
     * @param $nDisLike
     * @param $userID
     */
    public function __construct($idpost, $iduser, $titolo, $data, $deleted, $commentList, $likeList,ETravel $travel, $nLike, $nDisLike)
    {

        $this->title = $titolo;
        $this->commentList = $commentList;
        $this->likeList = $likeList;
        $this->creationDate = $data;
        $this->travel = new ETravel($travel->getTravelID(), $travel->getPostID(), $travel->getExperienceList(), $travel->getImageList(), $travel->getStartDate(), $travel->getFinishDate());
        $this->postID = $idpost;
        $this->deleted = $deleted;
        $this->nLike = $nLike;
        $this->nDisLike = $nDisLike;
        $this->userID = $iduser;
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
     * @return ETravel
     */
    public function getTravel(): ETravel
    {
        return $this->travel;
    }

    /**
     * @param ETravel $travel
     */
    public function setTravel(ETravel $travel): void
    {
        $this->travel = $travel;
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
}