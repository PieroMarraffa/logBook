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


class testPippo{
    public static function test(){
        $e = array();
       $user = FUser::load('IDuser', '6');
       $commento = new EComment(4, $user, 0, $e, 'non vedo la ora di fare questo viaggio');
        //$pl = FPlace::load('IDplace', '10');
        //$exp = new EExperience(8, '2021-12-24', '2021-12-27', 'Natale a Giulianova', $pl, 'davvero divertente');
        return FComment::exist('IDcomment', 7);
    }
}

$e = testPippo::test();

echo var_dump($e);