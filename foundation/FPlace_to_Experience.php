<?php


class FPlace_to_Experience extends FDataBase
{
    public static $class="FPlace_to_Experience";

    public static $table="place_to_experience";

    public static $value="(:IDExperience,:IDPlace)";

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

    public function load($field,$id){
        $database=FDataBase::getInstance();
        return $database->loadById(self::getTable(),$field,$id);
    }

    public function store($id){
        $database=FDataBase::getInstance();
        //DA FINIRE MI BUGGA IL FATTO CHE NON ESISTE UNA ENTITY ASSOCIATA A QUESTA FOUNDATION
    }

}