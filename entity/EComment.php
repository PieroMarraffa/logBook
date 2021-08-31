<?php

class EComment{
    private $commentID;
    private $author;
    private $eliminated;
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

    public function __construct($commentID, $author, $eliminated, $signaledList, $content)
    {
        $this->commentID = $commentID;
        $this->author = $author;
        $this->eliminated = $eliminated;
        $this->signaledList = $signaledList;
        $this->content = $content;
    }

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

    }