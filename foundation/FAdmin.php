<?php


class FAdmin
{
    public static $class="FAdmin";

    public static $table="admin";

    public static $value="(:IDadmin,:Email,:Password,:Username)";


    public function __constructor(){}


    public static function checkCredentials($email, $password){
        $database = FDataBase::getInstance();
        $result = $database->verifiedAccess(FAdmin::getClass(),$email);
        if ($result != null){
            return false;
        } else{
            return true;
        }
    }


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

    /** Restituisce l'oggetto o gli oggetti in cui il campo $field==$id
     * @throws Exception
     */
    public static function loadAdmin($field,$id){
        $admin=null;
        $database=FDataBase::getInstance();
        $result= $database->loadById(self::getTable(),$field,$id);
        $rows_number = $database->interestedRows(static::getClass(), $field, $id);
        if(($result != null) && ($rows_number == 1)) {
            $admin = new EAdmin($result['Username'], $result['Password'],$result['Email']);
        }

        return $admin;
    }


}