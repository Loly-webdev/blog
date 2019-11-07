<?php
$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($uri, PHP_URL_PATH),"/");
$params = explode('/', $uri);
$controllerName = $params[0] ?? 'home';
$methodeName = $params[1] ?? 'index';

$controllerName = null;
if (isset($params[0])) {
    $controllerName = $params[0];
}

abstract class DefaultController{
    abstract function index();
}

class HomeController{

}

class PostController {
    public function shaw()
    {
        $postId = $_GET['id'];
    }

    public function index()
    {

    }
}