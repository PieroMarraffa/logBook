<?php


class UCookie
{
    public static function getIsSet($id){
        if (isset($_COOKIE[$id])){
            return true;
        } else{
            return false;
        }
    }

}