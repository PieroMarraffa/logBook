<?php

class EComment{
    private $commentID;
    private $idPost;
    private $author;
    private $deleted;
    private $signaledList;
    private $content;

    /**
     * EComment constructor.
     * @param $commentID
     * @param $author
     * @param $eliminated
     * @param $signaledList
     * @param $content
     */


    //--------------COSTRUTTORE----------------------


    public function __construct($commentID, $idPost,EUser $author, $deleted, $signaledList, $content)
    {
        $this->commentID = $commentID;
        $this->idPost=$idPost;
        $this->author = $author;
        $this->deleted = $deleted;
        $this->signaledList = $signaledList;
        $this->content = $content;
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
     * @param mixed $eliminated
     */
    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return mixed
     */
    public function getSignaledList()
    {
        return $this->signaledList;
    }

    /**
     * @param mixed $signaledList
     */
    public function setSignaledList($signaledList): void
    {
        $this->signaledList = $signaledList;
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
        array_push($this->signaledList, $signalator);
    }

    public function removeSignalator($pos){
        unset($this->signaledList[$pos]);
        $this->signaledList = array_values($this->signaledList);
    }

    }