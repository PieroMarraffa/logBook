<?php



class post{

   //private static int $IDPost;
    private UtenteRegistrato $Autore;
    private string $Titolo;
    private array $ListaLike;
    private int $LikeNumero;
    private array $ListaCommenti;
    private Data $Periodo;
    private string $Descrizione;
    private array $ListaPagine;
    private array $ListaImmagini;
    private Data $DataCreazione;
    private array $ListaLuoghiDelViaggio;

    public function __construct(string $Titolo,data $Periodo, string $Descrizione, array $ListaImmagini, array $ListaPagine, arrayv $listaLuoghiDelViaggio){
        $this->Titolo0=$Titolo;
        $this->Periodo=$Periodo;
        $this->Descrizione=$Descrizione;
        $this->ListaImmagini=$ListaImmagini;
        $this->ListaPagine=$ListaPagine;
        $this->ListaLuoghiDelViaggio=$listaLuoghiDelViaggio;

    }


    public function getAutore(): string
    {
        return $this->Autore;
    }

    public function getTitolo(): string
    {
        return $this->Titolo;
    }

    public function getListaLike(): array
    {
        return $this->ListaLike;
    }

    public function getLikeNumero(): int
    {
        return $this->LikeNumero;
    }

    public function getListaCommenti(): array
    {
        return $this->ListaCommenti;
    }

    public function getPeriodo(): data
    {
        return $this->Periodo;
    }

    public function getDescrizione(): string
    {
        return $this->Descrizione;
    }

    public function getListaPagine(): array
    {
        return $this->ListaPagine;
    }

    public function getListaImmagini(): array
    {
        return $this->ListaImmagini;
    }

    public function getDataCreazione(): Data
    {
        return $this->DataCreazione;
    }

    public function getListaLuoghiDelViaggio()
    {
        return $this->ListaLuoghiDelViaggio;
    }


    public function setAutore(string $Autore): void
    {
        $this->Autore = $Autore;
    }

    public function setTitolo(string $Titolo): void
    {
        $this->Titolo = $Titolo;
    }

   public function setListaLike(array $ListaLike): void
    {
        $this->ListaLike = $ListaLike;
    }

    public function setLikeNumero(int $LikeNumero): void
    {
        $this->LikeNumero = $LikeNumero;
    }

    public function setListaCommenti(array $ListaCommenti): void
    {
        $this->ListaCommenti = $ListaCommenti;
    }

    public function setPeriodo(data $Periodo): void
    {
        $this->Periodo = $Periodo;
    }

    public function setDescrizione(string $Descrizione): void
    {
        $this->Descrizione = $Descrizione;
    }

    public function setListaPagine(array $ListaPagine): void
    {
        $this->ListaPagine = $ListaPagine;
    }

    public function setListaImmagini(array $ListaImmagini): void
    {
        $this->ListaImmagini = $ListaImmagini;
    }

    public function setDataCreazione(Data $DataCreazione): void
    {
        $this->DataCreazione = $DataCreazione;
    }

    public function setListaLuoghiDelViaggio($ListaLuoghiDelViaggio): void
    {
        $this->ListaLuoghiDelViaggio = $ListaLuoghiDelViaggio;
    }
}