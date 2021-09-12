<?php

require '../logBook/foundation/FDataBase.php';
require '../logBook/foundation/FUser.php';
require '../logBook/entity/EUser.php';


class test
{
    public static function trySelectReportedPosts(){
        $db = new FDataBase();
        $eu = new EUser(6, 'paoloattardi@gmail.com', 'Balu', 'Paolo', 'proprio una bella persona, a volte...',
            'immagine/orsacchiotto/Balu/gatto', 'JuPub8', '0');
        FUser::newUserToDB(6, 'paoloattardi@gmail.com', 'Balu', 'Paolo', 'proprio una bella persona, a volte...',
            'immagine/orsacchiotto/Balu/gatto', 'JuPub8', '0');
        echo var_dump($db->getAllByTable('user'));
    }
}

test::trySelectReportedPosts();