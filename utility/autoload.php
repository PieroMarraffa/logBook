<?php

function my_autoloader($className) {

        $firstLetter = $className[0];
        switch ($firstLetter) {
            case 'E':
                include_once( 'entity/'. $className . '.php' );
                break;

            case 'F':
                include_once( 'foundation/'. $className . '.php' );
                break;

            case 'V':
                include_once( 'view/'. $className . '.php' );
                break;

            case 'C':
                include_once( 'controller/'. $className . '.php' );
                break;

            case 'I':
                include_once( $className . '.php' );
                break;
            /*
                    case 'S':
                        include_once( $className . '.php' );
                        break;
            */
        }
}

spl_autoload_register('my_autoloader');

