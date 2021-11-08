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
            $pm = FPersistentManager::getInstance();
            $pm->deleteAllFromPlaceToUser(3);
            $listaPlaceID = $pm->loadAllPlaceIDByUser(3);
            $listaPlaceIDDaSalvare[0] = $listaPlaceID[0];
            foreach ($listaPlaceID as $id){
                $salvabile = false;
                foreach ($listaPlaceIDDaSalvare as $s){
                    if ($id != $s){
                        $salvabile=true;
                    }
                }
                if ($salvabile == true){
                    $listaPlaceIDDaSalvare[] = $id;
                }
            }
            foreach ($listaPlaceIDDaSalvare as $s){
                $pm->storePlaceToUser(3, $s);
            }
            echo var_dump($listaPlaceIDDaSalvare);
        }

}

testPippo::test();
//echo var_dump(testPippo::test());

