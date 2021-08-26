<?php

class commento{
    private UtenteRegistrato $Autore;
    private bool $Eliminato;
    private array $ListaSegnalati;
    private string $contenuto;

    public function __construct(UtenteRegistrato $Autore, bool $Eliminato, array $ListaSegnalati, string $contenuto)
    {
        $this->Autore = $Autore;
        $this->Eliminato = $Eliminato;
        $this->ListaSegnalati = $ListaSegnalati;
        $this->contenuto = $contenuto;
    }

    public function getAutore(): UtenteRegistrato
    {
        return $this->Autore;
    }

    public function isEliminato(): bool
    {
        return $this->Eliminato;
    }

    public function getListaSegnalati(): array
    {
        return $this->ListaSegnalati;
    }

    public function getContenuto(): string
    {
        return $this->contenuto;
    }

    public function setAutore(UtenteRegistrato $Autore): void
    {
        $this->Autore = $Autore;
    }

    public function setEliminato(bool $Eliminato): void
    {
        $this->Eliminato = $Eliminato;
    }

    public function setListaSegnalati(array $ListaSegnalati): void
    {
        $this->ListaSegnalati = $ListaSegnalati;
    }

    public function setContenuto(string $contenuto): void
    {
        $this->contenuto = $contenuto;
    }
}