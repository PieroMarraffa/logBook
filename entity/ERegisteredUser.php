<?php


class ERegisteredUser extends EPerson
{
    private EProfile $profile;
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
     * ERegisteredUser constructor.
     * @param EProfile $profile
     */
    public function __construct(EProfile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return EProfile
     */
    public function getProfile(): EProfile
    {
        return $this->profile;
    }

    /**
     * @param EProfile $profile
     */
    public function setProfile(EProfile $profile): void
    {
        $this->profile = $profile;
    }


}