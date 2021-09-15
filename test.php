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
    /**
     * @throws Exception
     */
    public static function trySelectReportedPosts(){

        //$i=new EImage("FFFFFFFFFFFFFFFFFFFFFFFFFF",1,200,200);
        //$e=new EUser("gigio","pippi","g","g","huh","gyg",0);
        //$s=new EPlace("casaDiPippi",42,42,"luogo_bestemmia");
        //$l=FUser::load('Email','giuliacancello@gmail.com');

        //FLike::delete("IDreaction",1);
        //FPost::storePlaceAssociatedToPost(1,2);


        // $e=new EUser("gigio","pippi","g","g","huh","gyg",0);
        //$l=FUser::load('Email','giuliacancello@gmail.com');

        //$l=FPlace::store($s);
        //$l=FComment::load("IDcomment",1);
        //$l->setCommentID("");
        $l=FPost::load("IDpost",1);
        $l->setPostID("");
        FPost::store($l);


        echo var_dump($l);




    }
}

test::trySelectReportedPosts();
//echo var_dump($l);

