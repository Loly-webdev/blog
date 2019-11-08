<?php

require('core/DefaultController.php');

// Place the value from ?page=value in the URL to the variable $page.
$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($server, PHP_URL_PATH), "/");
$params = explode('/', $serverData);
$page = reset($params);
if ('' != $page) {
    require('view/frontend/' . $page . '.php');
} elseif ($page = 'listPostsView') {
    require('controller/BlogController.php');
    try {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'listPosts') {
                listPosts();
            } elseif ($_GET['action'] == 'post') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post();
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            } elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
        } else {
            require('view/frontend/homeView.php');
        }
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}


