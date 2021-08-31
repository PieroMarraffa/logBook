<?php


class ELike
{
    private int $value;
    private EProfile $author;
    private int $likeID;

    /**
     * @return int
     */
    public function getLikeID(): int
    {
        return $this->likeID;
    }

    /**
     * @param int $likeID
     */
    public function setLikeID(int $likeID): void
    {
        $this->likeID = $likeID;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return EProfile
     */
    public function getAuthor(): EProfile
    {
        return $this->author;
    }

    /**
     * @param EProfile $author
     */
    public function setAuthor(EProfile $author): void
    {
        $this->author = $author;
    }
}