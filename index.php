<?php

require('core/DefaultController.php');

// Place the value from ?page=value in the URL to the variable $page.
$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($server, PHP_URL_PATH), "/");
$params = explode('/', $serverData);
$page = reset($params);
if ('' != $page) {
    require('view/frontend/' . $page . '.php');
} else {
    require('view/frontend/homeView.php');
}

if ($page == 'listPostsView') {
    require('controller/BlogController.php');

    if ($_GET['action'] == 'listPosts') {
        listPosts();
    } elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } else {
        listPosts();
    }
}

//$controllerName = $params[0] ?? 'home';
//$methodeName = $params[1] ?? 'index';

//$controllerName = null;
//if (isset($params[0])) {
//    $controllerName = $params[0];
//}
