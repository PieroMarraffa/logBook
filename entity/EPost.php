<?php


class EPost
{
    private EPerson $author;
    private String $title;
    private array $commentList;
    private array $likeList;
    private \Cassandra\Date $creationDate;
    private EExperience $experience;
    private int $postID;

    /**
     * @return int
     */
    public function getPostID(): int
    {
        return $this->postID;
    }

    /**
     * @param int $postID
     */
    public function setPostID(int $postID): void
    {
        $this->postID = $postID;
    }

    /**
     * @return EPerson
     */
    public function getAuthor(): EPerson
    {
        return $this->author;
    }

    /**
     * @param EPerson $author
     */
    public function setAuthor(EPerson $author): void
    {
        $this->author = $author;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getCommentList(): array
    {
        return $this->commentList;
    }

    /**
     * @param array $commentList
     */
    public function setCommentList(array $commentList): void
    {
        $this->commentList = $commentList;
    }

    /**
     * @return array
     */
    public function getLikeList(): array
    {
        return $this->likeList;
    }

    /**
     * @param array $likeList
     */
    public function setLikeList(array $likeList): void
    {
        $this->likeList = $likeList;
    }

    /**
     * @return \Cassandra\Date
     */
    public function getCreationDate(): \Cassandra\Date
    {
        return $this->creationDate;
    }

    /**
     * @param \Cassandra\Date $creationDate
     */
    public function setCreationDate(\Cassandra\Date $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return EExperience
     */
    public function getExperience(): EExperience
    {
        return $this->experience;
    }

    /**
     * @param EExperience $experience
     */
    public function setExperience(EExperience $experience): void
    {
        $this->experience = $experience;
    }
}