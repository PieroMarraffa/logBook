<?php

require_once 'StartSmarty.php';

class CFrontController
{
    public function run($path){

        $res=explode("/",$path);

        array_shift($res);
        array_shift($res);

        if ($res[0] != 'api') {

            $controller = "C" . $res[0];
            $dir = 'controller';
            $eledir = scandir($dir);

            if (in_array($controller . ".php", $eledir)) {
                if (isset($resource[1])) {
                    $function = $resource[1];
                    if (method_exists($controller, $function)) {

                        $param = array();
                        for ($i = 2; $i < count($resource); $i++) {
                            $param[] = $resource[$i];
                            $a = $i - 2;
                        }
                        $num = (count($param));
                        if ($num == 0) $controller::$function();
                        else if ($num == 1) $controller::$function($param[0]);
                        else if ($num == 2) $controller::$function($param[0], $param[1]);
                        else if ($num == 3) $controller::$function($param[0], $param[1], $param[2]);
                        else if ($num == 4) $controller::$function($param[0], $param[1], $param[2], $param[3]);
                        else if ($num == 5) $controller::$function($param[0], $param[1], $param[2], $param[3], $param[4]);
                        //else if ($num == 6) $controller::$function($param[0], $param[1], $param[2], $param[3], $param[4], $param[5]);

                    } else {
                        if (CUser::isLogged()) {

                            $utente = unserialize(USession::getElement('utente'));
                            $adm=FPersistentManager::loadAdmin("Email",$utente->getEmail());
                            if (isset($adm))
                                header('Location: '); /** dobbiamo vede che metterci */
                            else {
                                //$smarty = StartSmarty::configuration();
                                //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                                header('Location: ');
                            }
                        } else {
                            //$smarty = StartSmarty::configuration();
                            //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                            header('Location: ');
                        }
                    }
                } else {
                    if (CUser::isLogged()) {

                        $utente = unserialize(USession::getElement('utente'));
                        $adm=FPersistentManager::loadAdmin("Email",$utente->getEmail());
                        if (isset($adm))
                            header('Location: '); /** dobbiamo vede che metterci */
                        else {
                            //$smarty = StartSmarty::configuration();
                            //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                            header('Location: ');
                        }
                    } else {
                        //$smarty = StartSmarty::configuration();
                        //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                        header('Location: ');
                    }
                }
            } else {
                if (CUser::isLogged()) {

                    $utente = unserialize(USession::getElement('utente'));
                    $adm=FPersistentManager::loadAdmin("Email",$utente->getEmail());
                    if (isset($adm))
                        header('Location: '); /** dobbiamo vede che metterci */
                    else {
                        //$smarty = StartSmarty::configuration();
                        //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                        header('Location: ');
                    }
                } else {
                    //$smarty = StartSmarty::configuration();
                    //CRicerca::trasportiHome();/** dobbiamo vede che metterci */
                    header('Location: ');
                }
            }
        }
    }
}