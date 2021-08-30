<?php

class Comment{
    private int $commentID;
    private RegisteredUser $author;
    private bool $eliminated;
    private array $signaledList;
    private string $content;

    public function __construct(RegisteredUser $autore, bool $eliminated, array $signaledList, string $content)
    {
        $this->author = $autore;
        $this->eliminated = $eliminated;
        $this->signaledList = $signaledList;
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getCommentID(): int
    {
        return $this->commentID;
    }

    /**
     * @param int $commentID
     */
    public function setCommentID(int $commentID): void
    {
        $this->commentID = $commentID;
    }

    public function getAuthor(): UtenteRegistrato
    {
        return $this->author;
    }

    public function isEliminated(): bool
    {
        return $this->eliminated;
    }

    public function getSignaledList(): array
    {
        return $this->signaledList;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setAuthor(UtenteRegistrato $author): void
    {
        $this->author = $author;
    }

    public function setEliminated(bool $eliminated): void
    {
        $this->eliminated = $eliminated;
    }

    public function setSignaledList(array $signaledList): void
    {
        $this->signaledList = $signaledList;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}