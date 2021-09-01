<?php

class EComment{
    private $commentID;
    private $author;
    private $eliminated;
    /**
     * Elenco di segnalatori
     * @AttributeType Array<EProfile>
     */
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


    public function __construct($commentID, EProfile $author, $eliminated, $content)
    {
        $this->commentID = $commentID;
        $this->author = new EProfile($author->getUtentName(), $author->getImgPathFile(),
            $author->getDescription(), $author->getProfileID());
        $this->eliminated = $eliminated;
        $this->signaledList = array();
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
    public function getEliminated()
    {
        return $this->eliminated;
    }

    /**
     * @param mixed $eliminated
     */
    public function setEliminated($eliminated): void
    {
        $this->eliminated = $eliminated;
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

    public function addSignalator(EProfile $signalator){
        array_push($this->signaledList, $signalator);
    }

    public function removeSignalator($pos){
        unset($this->signaledList[$pos]);
        $this->signaledList = array_values($this->signaledList);
    }

    }