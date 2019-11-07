<?php
// Place the value from ?page=value in the URL to the variable $page.
$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($server, PHP_URL_PATH),"/");
$params = explode('/', $serverData);
$page = reset($params);
if ('' != $page) {
    require('view/frontend/'. $page .'.php');
} else {
    require('view/frontend/homeView.php');
}