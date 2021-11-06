<?php


class EUser
{
    private $userID;
    private $userName;
    private $name;
    private $password;
    private $mail;
    private $IDimage;
    private $description;
    private $reported;
    private $banned;



    /**
     * EUser constructor.
     * @param $userID
     * @param $username
     * @param $name
     * @param $password
     * @param $email
     * @param $IDimage
     * @param $description
     * @param $reported
     * @param $banned
     */
    public function __construct( $email, $password, $name, $description, $IDimage, $username,$reported, $banned)
    {
        $this->userName = $username;
        $this->name = $name;
        $this->password = $password;
        $this->mail = $email;
        $this->IDimage = $IDimage;
        $this->description = $description;
        $this->reported=$reported;
        $this->banned = $banned;
    }


    /**
     * @return mixed
     */
    public function getIDimage()
    {
        return $this->IDimage;
    }

    /**
     * @param mixed $IDimage
     */
    public function setIDimage($IDimage): void
    {
        $this->IDimage = $IDimage;
    }

    /**
     * @return mixed
     */
    public function getReported()
    {
        return $this->reported;
    }

    /**
     * @param mixed $reported
     */
    public function setReported($reported): void
    {
        $this->reported = $reported;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
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

    /**
     * @return mixed
     */
    public function getImageID()
    {
        return $this->IDimage;
    }

    /**
     * @param mixed $imgPathFile
     */
    public function setImageID($IDimage): void
    {
        $this->IDimage = $IDimage;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned;
    }

    /**
     * @param bool $banned
     */
    public function setBanned(bool $banned): void
    {
        $this->banned = $banned;
    }


}