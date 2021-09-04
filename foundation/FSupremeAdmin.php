<?php


class FSupremeAdmin
{
    public static $class="FSupremeAdmin";

    public static $table="supreme_admin";

    public static $value="(:IDadmin,:Email,:Password)";

    public function __constructor(){}

    /**
     * @return string
     */
    public static function getClass()
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValue()
    {
        return self::$value;
    }

    public static function createAdmin($idUser){
        $result=FUser::update("Admin",$idUser,true);
        return $result;
    }

    public static function deleteAdmin($idUser){
        $result=FUser::update("Admin",$idUser,false);
        return $result;
    }


    /** Ricordati di fare il login per il supreme admin */
}