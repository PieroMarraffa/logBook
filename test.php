<?php


require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';

class test
{
    public static function trySelectReportedPosts(){

         $e=new EUser("gino","pippi","g","g","huh","gyg",0);
         FUser::store($e);
         $l=FUser::load("Email","gino");
         return $l;
    }
}

$e=test::trySelectReportedPosts();
echo isset($e);