<?php


class RegisteredUser extends Person
{
    private Profile $profile;
    private int $registeredUserID;

    /**
     * @return int
     */
    public function getRegisteredUserID(): int
    {
        return $this->registeredUserID;
    }

    /**
     * @param int $registeredUserID
     */
    public function setRegisteredUserID(int $registeredUserID): void
    {
        $this->registeredUserID = $registeredUserID;
    }

    /**
     * RegisteredUser constructor.
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }


}