<?php
// Defines a message according to the error code and associates the parameters
$errorCode = $_GET['erreur'];

switch ($errorCode) {
    case '204':
        $errorMessage = 'Cette page ne contient rien! (204)';
    break;
    case '205':
        $errorMessage = 'Cette page n\'est pas accessible';
    break;
    case '206':
        $errorMessage = 'Contenu partiel de la page! (206)';
    break;
    // 3** redirection
    case '301':
        $errorMessage = 'La page a été déplacéé définitivement!(301)';
    break;
    case '302':
        $errorMessage = 'La page a été déplacéé momentanément!(302)';
    break;
    // 4** error customer
    case '400':
        $errorMessage = 'Erreur dans la requête HTTP! (400)';
    break;
    case '401':
        $errorMessage = 'Authentification requise! (401)';
    break;
    case '402':
        $errorMessage = 'L\'accès à la page est payant! (402)';
    break;
    case '403':
        $errorMessage = 'Accès à la page refusé! (403)';
    break;
    case '404':
        $errorMessage = 'Page inexistante! (404)';
    break;
    case '405':
        $errorMessage = 'Méthode non autorisée.';
    break;
    // 5** error server
    case '500':
        $errorMessage = 'Erreur interne au serveur ou serveur saturé.';
    break;
    case '501':
        $errorMessage = 'Le serveur ne supporte pas le service demandé.';
    break;
    case '502':
        $errorMessage = 'Mauvaise passerelle.';
    break;
    case '503':
        $errorMessage = ' Service indisponible.';
    break;
    case '504':
        $errorMessage = 'Trop de temps à la réponse.';
    break;
    case '505':
        $errorMessage = 'Version HTTP non supportée.';
    break;
    default:
        $errorMessage = 'Erreur !';
}

require_once('../template/errors/errorsPageView.php');
