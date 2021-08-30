<?php


class Person
{
    private String $name;
    private bool $admin;
    private String $password;
    private int $personID;
    private String $mail;


    /**
     * Person constructor.
     * @param String $name
     * @param bool $admin
     * @param String $password
     * @param int $personID
     * @param String $mail
     */
    public function __construct(string $name, bool $admin, string $password, int $personID, string $mail)
    {
        $this->name = $name;
        $this->admin = $admin;
        $this->password = $password;
        $this->personID = $personID;
        $this->mail = $mail;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getPersonID(): int
    {
        return $this->personID;
    }

    /**
     * @param int $personID
     */
    public function setPersonID(int $personID): void
    {
        $this->personID = $personID;
    }

    /**
     * @return String
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param String $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }


}