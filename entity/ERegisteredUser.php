<?php


class ERegisteredUser extends EPerson
{
    private $profile;
    private $registeredUserID;

    public function __construct($nome, $admin, $pass, $personID ,$mail , $profile , $rUID ) {
        parent::__construct($nome , $admin , $pass ,$personID, $mail);
        $this->profile = $profile;
        $this->registeredUserID = $rUID;
    }


    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getRegisteredUserID()
    {
        return $this->registeredUserID;
    }

    /**
     * @param mixed $registeredUserID
     */
    public function setRegisteredUserID($registeredUserID)
    {
        $this->registeredUserID = $registeredUserID;
    }


}