<?php


require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';

class test
{
    public static function trySelectReportedPosts(){
        $pm=FUser::load("Name","federico");
        return $pm;
    }
}

$e=test::trySelectReportedPosts();
echo isset($e);