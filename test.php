<?php

require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FAdmin.php';
require '../logBook/foundation/FComment.php';
require '../logBook/foundation/FExperience.php';
require '../logBook/foundation/FImage.php';
require '../logBook/foundation/FLike.php';
require '../logBook/foundation/FPersistentManager.php';
require '../logBook/foundation/FPlace.php';
require '../logBook/foundation/FPost.php';
require '../logBook/foundation/FTravel.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EAdmin.php';
require '../logBook/entity/EComment.php';
require '../logBook/entity/EExperience.php';
require '../logBook/entity/EImage.php';
require '../logBook/entity/ELike.php';
require '../logBook/entity/EPlace.php';
require '../logBook/entity/EPost.php';
require '../logBook/entity/ETravel.php';
require '../logBook/entity/EUser.php';

class test
{
    public static function trySelectReportedPosts(){

<<<<<<< Updated upstream
        //$e=new EUser("gigio","pippi","g","g","huh","gyg",0);
        $s=new ELike("-1",1,1);
        //$l=FUser::load('Email','giuliacancello@gmail.com');

        $d=FLike::update("Reaction","-1",1);
        //$l=FUser::load("Password","Silvia");
=======
        /** $e=new EUser("gigio","pippi","g","g","huh","gyg",0);*/
        /** $l=FUser::load('Email','giuliacancello@gmail.com'); */

        /** FUser::store($e);*/
        $l=FPlace::update('Category', 'Schifo', 2) ;
>>>>>>> Stashed changes


         return $d;
    }
}

$e=test::trySelectReportedPosts();
<<<<<<< Updated upstream
echo $e;
=======

echo var_dump($e);
>>>>>>> Stashed changes
