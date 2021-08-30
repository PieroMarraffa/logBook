<?php


class Post
{
    private Person $author;
    private String $title;
    private array $commentList;
    private array $likeList;
    private \Cassandra\Date $creationDate;
    private Experience $experience;

    /**
     * @return Person
     */
    public function getAuthor(): Person
    {
        return $this->author;
    }

    /**
     * @param Person $author
     */
    public function setAuthor(Person $author): void
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
     * @return Experience
     */
    public function getExperience(): Experience
    {
        return $this->experience;
    }

    /**
     * @param Experience $experience
     */
    public function setExperience(Experience $experience): void
    {
        $this->experience = $experience;
    }
}