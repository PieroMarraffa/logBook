<?php

/**
 * Classe che si occupa dell'installazione dell'applicativo
 */
class Installation{
    /**
     * Funzione che si occupa del controllo dei requisiti minimi per l'installazione, ovvero:
     * PHP version 7 o maggiore
     * Cookie abilitati
     * JavaScript abilitato
     *
     * @throws SmartyException
     */
    static function begin(){
        $smarty = StartSmarty::configuration();
        if (UServer::getRequestMethod() == 'GET'){
            // viene inviato un cookie per verificare se questi sono abilitati
            $smarty->display('installazione.tpl');
        }
        else {
            $noPHP = false;

            // controllo versione PHP
            if (version_compare(PHP_VERSION,'7.0.0' , '<' )) {
                $noPHP = true;
                $smarty->assign('nophpv', $noPHP);
            }

            // se almeno uno dei controlli non è andato a buon fine, si mostra la pagina di installazione con i relativi errori.
            if ($noPHP){
                $smarty->display('installazione.tpl');
            }
            // altrimenti, se i requisiti sono verificati elimino i cookie inviati in precedenza
            else {
                // si procede con l'installazione e il popolamento del db
                static::install();
                header ('Location: /logBook/home');
            }

        }
    }

    /**
     * Creazione del file config.inc.php per l'accesso e la creazione del db
     */
    static function install(){
        try {
            $db = new PDO("mysql:dbname=logbook;host=127.0.0.1; charset=utf8;", $_POST['nomeutente'], $_POST['password']);
            $db->beginTransaction();
            $query = 'DROP DATABASE IF EXISTS ' . $_POST['nomedb'] . '; CREATE DATABASE ' . $_POST['nomedb'] . ' ; USE ' . $_POST['nomedb'] . ';' . 'SET GLOBAL max_allowed_packet=16777216;';
            $query = $query . file_get_contents('logbook.sql');
            $db->exec($query);
            $db->commit();
            $file = fopen('config.inc.php', 'c+');
            $script = '<?php $GLOBALS[\'database\']= \'' . $_POST['nomedb'] . '\'; $GLOBALS[\'username\']=  \'' . $_POST['nomeutente'] . '\'; $GLOBALS[\'password\']= \'' . $_POST['password'] . '\';?>';
            fwrite($file, $script);
            fclose($file);
        }catch(PDOException $e){
            $db->rollBack();
            die;
        }
    }

    /**
     * Funzione che verifica la presenza del cookie di installazione; quindi se l'installazione è stata effettuata
     */
    static function verificaInstallazione(){
        $verifica = false;
        if(file_exists('config.inc.php'))
            $verifica = true;
        return $verifica;
    }


}
