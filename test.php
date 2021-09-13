<?php

require '../logBook/entity/ETravel.php';
require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';
require '../logBook/foundation/FPost.php';
require '../logBook/entity/EPost.php';

class test
{
    public static function trySelectReportedPosts(){

        //$e=new EPlace("caput_mundi",51,52,"nazione");
        //$l=FUser::loadPlaceByUser(1);
        //FUser::storePlaceToUser(1,2);
        //$l=FPlace::load("Category","nazione");
        $l=FUser::loadPostReportedByUser("2");

         return $l;
    }
}

$e=test::trySelectReportedPosts();
echo $e;