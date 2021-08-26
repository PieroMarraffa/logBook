<?php


class Profilo
{
    private String $nomeUtente;
    private String $imgPathFile;
    private String $description;
    private array $likedPosts;
    private array $personalPosts;
    private array $visitedPlaces;

    /**
     * @return String
     */
    public function getNomeUtente(): string
    {
        return $this->nomeUtente;
    }

    /**
     * @param String $nomeUtente
     */
    public function setNomeUtente(string $nomeUtente): void
    {
        $this->nomeUtente = $nomeUtente;
    }

    /**
     * @return String
     */
    public function getImgPathFile(): string
    {
        return $this->imgPathFile;
    }

    /**
     * @param String $imgPathFile
     */
    public function setImgPathFile(string $imgPathFile): void
    {
        $this->imgPathFile = $imgPathFile;
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getLikedPosts(): array
    {
        return $this->likedPosts;
    }

    /**
     * @param array $likedPosts
     */
    public function setLikedPosts(array $likedPosts): void
    {
        $this->likedPosts = $likedPosts;
    }

    /**
     * @return array
     */
    public function getPersonalPosts(): array
    {
        return $this->personalPosts;
    }

    /**
     * @param array $personalPosts
     */
    public function setPersonalPosts(array $personalPosts): void
    {
        $this->personalPosts = $personalPosts;
    }

    /**
     * @return array
     */
    public function getVisitedPlaces(): array
    {
        return $this->visitedPlaces;
    }

    /**
     * @param array $visitedPlaces
     */
    public function setVisitedPlaces(array $visitedPlaces): void
    {
        $this->visitedPlaces = $visitedPlaces;
    }


}