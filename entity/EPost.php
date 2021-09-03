<?php


use Cassandra\Date;

class EPost
{
    private $author;
    private $title;
    private $commentList;
    private $likeList;
    private $creationDate;
    private $experience;
    private $postID;
    private $deleted;

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
    public function __construct($author, $title, $creationDate,EExperience $experience, $postID,$deleted)
    {
        $this->author = $author;
        $this->title = $title;
        $this->commentList = array();
        $this->likeList = array();
        $this->creationDate = new Date($creationDate);
        $this->experience = new EExperience($experience->getExperienceID(),$experience->getStartDay(),
            $experience->getEndDay(), $experience->getTitle(),$experience->getPlaceList(),
            $experience->getDescription(),$experience->getImageList(),$experience->getExperienceList());
        $this->postID = $postID;
        $this->deleted=$deleted;
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