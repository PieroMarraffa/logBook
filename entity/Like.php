<?php


class Like
{
    private int $value;
    private Profile $author;

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
     * @return Profile
     */
    public function getAuthor(): Profile
    {
        return $this->author;
    }

    /**
     * @param Profile $author
     */
    public function setAuthor(Profile $author): void
    {
        $this->author = $author;
    }
}