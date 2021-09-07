<?php


class FAdmin
{
    public static $class="FAdmin";

    public static $table="admin";

    public static $value="(:IDadmin,:Email,:Password,:Username)";

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
        return $result;
    }


}