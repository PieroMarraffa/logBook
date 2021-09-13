<?php

require '../logBook/entity/EPlace.php';
require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';

class test
{
    public static function trySelectReportedPosts(){

        //$e=new EUser("gigio","pippi","g","g","huh","gyg",0);
        $l=FUser::loadPlaceByUser(1);

        //FUser::store($e);
        //$l=FUser::load("Password","Silvia");


         return $l;
    }
}

$e=test::trySelectReportedPosts();
echo $e->getCategory();