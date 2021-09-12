<?php


require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';

class test
{
    public static function trySelectReportedPosts(){

         //$e=new EUser("gino","pippi","g","g","huh","gyg",0);
         $l=FUser::delete("Password","44444");
         //$l=FUser::load("Password","44444");
         return $l;
    }
}

$e=test::trySelectReportedPosts();
echo $e;