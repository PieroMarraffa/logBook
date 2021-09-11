<?php


class FAdmin
{
    public static $class="FAdmin";

    public static $table="admin";

    public static $value="(:IDadmin,:Email,:Password,:Username)";

    public static function checkCredentials(){
    }

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

    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id */
    public static function loadAdmin($field,$id){
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $deletedPost=FUser::load("Deleted",true);
            $deletedComment=FComment::load("Deleted",true);
            $admin = new EAdmin($result['Username'], $result['Password'],$result['Email'],$deletedPost,$deletedComment);
        }

        return $admin;
    }


}