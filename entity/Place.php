<?php


class Place
{
    private $IDLuogo;

    private $latitude;

    private $longitude;

    private $nazione;

    private $nVisitatoriMedi;

    private $listaMeteTuristiche;

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getNazione()
    {
        return $this->nazione;
    }

    /**
     * @param mixed $nazione
     */
    public function setNazione($nazione)
    {
        $this->nazione = $nazione;
    }

    /**
     * @return mixed
     */
    public function getNVisitatoriMedi()
    {
        return $this->nVisitatoriMedi;
    }

    /**
     * @param mixed $nVisitatoriMedi
     */
    public function setNVisitatoriMedi($nVisitatoriMedi)
    {
        $this->nVisitatoriMedi = $nVisitatoriMedi;
    }

    /**
     * @return mixed
     */
    public function getListaMeteTuristiche()
    {
        return $this->listaMeteTuristiche;
    }

    /**
     * @param mixed $listaMeteTuristiche
     */
    public function setListaMeteTuristiche($listaMeteTuristiche)
    {
        $this->listaMeteTuristiche = $listaMeteTuristiche;
    }

    /**
     * @return mixed
     */
    public function getIDLuogo()
    {
        return $this->IDLuogo;
    }

    /**
     * @param mixed $IDLuogo
     */
    public function setIDLuogo($IDLuogo)
    {
        $this->IDLuogo = $IDLuogo;
    }


}