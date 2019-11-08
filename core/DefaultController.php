<?php

abstract class DefaultController
{
    abstract function index();
}

$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($uri, PHP_URL_PATH),"/");
$params = explode('/', $uri);
$controllerName = $params[0] ?? 'home';
$methodeName = $params[1] ?? 'index';

$controllerName = null;
if (isset($params[0])) {
    $controllerName = $params[0];
}

class HomeController {
    public function index()
    {

    }
}

class PostsController {
    public function shaw()
    {
        $articleId = $_GET['id'];
    }

    public function index()
    {

    }
}

