<?php

class EComment{
    private $commentID;
    private $idPost;
    private $author;
    private $deleted;
    private $reportedList;
    private $content;

    /**
     * EComment constructor.
     * @param $commentID
     * @param $idPost
     * @param $author
     * @param $deleted
     * @param $reportedList
     * @param $content
     */


    //--------------COSTRUTTORE----------------------


    public function __construct( $idPost,EUser $author, $deleted, $signaledList, $content)
    {

        $this->idPost=$idPost;
        $this->author = $author;
        $this->deleted = $deleted;
        $this->reportedList = $signaledList;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param mixed $idPost
     */
    public function setIdPost($idPost): void
    {
        $this->idPost = $idPost;
    }



    //--------------METODI GETTER E SETTER----------------------


    /**
     * @return mixed
     */
    public function getCommentID()
    {
        return $this->commentID;
    }

    /**
     * @param mixed $commentID
     */
    public function setCommentID($commentID): void
    {
        $this->commentID = $commentID;
    }

    /**
 * @return mixed
 */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getAuthorID()
    {
        return $this->author->getUserID();
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
    public function getReportedList()
    {
        return $this->reportedList;
    }

    /**
     * @param mixed $reportedList
     */
    public function setReportedList($reportedList): void
    {
        $this->reportedList = $reportedList;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    //--------------METODI ADD TO LIST----------------------

    public function addSignalator(EUser $signalator){
        array_push($this->reportedList, $signalator);
    }

    public function removeSignalator($pos){
        unset($this->reportedList[$pos]);
        $this->reportedList = array_values($this->reportedList);
    }

    }