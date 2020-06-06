<?php
// Defines a message according to the error code and associates the parameters
$codeHTTP = http_response_code();

$codes = [
    204 => ['Erreur 204',
            'Cette page ne contient rien!'],
    205 => ['Erreur 205',
            'Cette page n\'est pas accessible'],
    206 => ['Erreur 206',
            'Contenu partiel de la page!'],
    // 3** redirection
    301 => ['Erreur 301',
            'La page a été déplacéé définitivement!(301)'],
    302 => ['Erreur 302',
            'La page a été déplacéé momentanément!(302)'],
    // 4** error customer
    400 => ['Erreur 400',
            'Erreur dans la requête HTTP!'],
    401 => ['Erreur 401',
            'Authentification requise!'],
    402 => ['Erreur 402',
            'L\'accès à la page est payant!'],
    403 => ['Erreur 403',
            'Accès à la page refusé!'],
    404 => ['Erreur 404',
            'Page inexistante!'],
    405 => ['Erreur 405',
            'Méthode non autorisée.'],
    408 => ['Erreur 408',
            'Your browser failed to send a request in the time allowed by the server.'],
    // 5** error server
    500 => ['Erreur 500',
            'Le serveur ne supporte pas le service demandé.'],
    501 => ['Erreur 501',
            'Le serveur ne supporte pas le service demandé.'],
    502 => ['Erreur 502',
            'The server received an invalid response while trying to carry out the request.'],
    504 => ['Erreur 504',
            'Le serveur met trop de temps à répondre.'],
    505 => ['Erreur 505',
            'Version HTTP non supportée.']
];

if ($codeHTTP === 200 || $codeHTTP == false || strlen($codeHTTP) != 3) {
    $code    = '';
    $message = 'Désolé nous rencontrons une erreur';
}
else {
    $code    = $codes[$codeHTTP][0] ?? $codeHTTP;
    $message = $codes[$codeHTTP][1] ?? 'Désolé nous rencontrons une erreur';
}

require_once('template/errorsPageView.php');
