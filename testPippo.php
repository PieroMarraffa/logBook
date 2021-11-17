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
    public static function test($a){
        $ad = explode(' ', $a);
        $address = implode('+', $ad);
        $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw");
        $array = json_decode($json, true);
        foreach ($array["results"][0]["address_components"] as $component){
            if ($component["types"][0] == "locality"){
                echo $component["long_name"];
            }
        }
        echo '   ';
        foreach ($array["results"][0]["address_components"] as $component){
            if ($component["types"][0] == "country"){
                echo $component["long_name"];
            }
        }
        echo '   ';
        echo $array["results"][0]["geometry"]["location"]["lat"];
        echo '   ';
        echo $array["results"][0]["geometry"]["location"]["lng"];
    }

    public static function test2(){
        $db = FDataBase::getInstance();
        $lat = 41.8933203;
        $lng = 12.482932;
        $prossimity = 0.05;
        $value = $db->loadPlaceProssimity($lat, $lng, $prossimity);
        echo var_dump($value);

    }
}

testPippo::test2();
//echo var_dump(testPippo::test());

