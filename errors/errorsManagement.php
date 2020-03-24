<?php

function errorsManagement($type, $message, $file, $line)
{
    switch ($type) {
        case E_ERROR:
        case E_PARSE:
        case E_CORE_ERROR:
        case E_CORE_WARNING:
        case E_COMPILE_ERROR:
        case E_COMPILE_WARNING:
        case E_USER_ERROR:
            $type = "Erreur fatale";
        break;

        case E_WARNING:
        case E_USER_WARNING:
            $type = "Avertissement";
        break;

        case E_NOTICE:
        case E_USER_NOTICE:
            $type = "Remarque";
        break;

        case E_STRICT:
            $type = "Syntaxe Obsolète";
        break;

        default:
            $type = "Erreur inconnue";
        break;
    }

    require_once('template/errors/errorsManagementView.php');
}
