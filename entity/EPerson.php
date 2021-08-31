<?php


class EPerson
{
    private $name;
    private $admin;
    private $password;
    private $personID;
    private $mail;

    /**
     * EPerson constructor.
     * @param $name
     * @param $admin
     * @param $password
     * @param $personID
     * @param $mail
     */

    public function __construct($name, $admin, $password, $personID, $mail)
    {
        $this->name = $name;
        $this->admin = $admin;
        $this->password = $password;
        $this->personID = $personID;
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin): void
    {
        $this->admin = $admin;
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
    public function getPersonID()
    {
        return $this->personID;
    }

    /**
     * @param mixed $personID
     */
    public function setPersonID($personID): void
    {
        $this->personID = $personID;
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