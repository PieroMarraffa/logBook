<?php


class EAdmin
{
    private $userName;
    private $password;
    private $mail;

    //--------------------COSTRUTTORE----------------

    /**
     * EAdmin constructor.
     * @param $userName
     * @param $password
     * @param $mail
     */
    public function __construct($userName, $password, $mail)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

}