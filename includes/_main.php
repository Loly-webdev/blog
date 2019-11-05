<?php
// Place the value from ?page=value in the URL to the variable $page.
$page = $_GET['page'];

// Create an array of the only pages allowed.
$pageArray = array(
    'home',
    'blog',
    'contact',
    'connexion',
    'comment',
    'post'
);

// Is $page in the array?
$inArray = in_array($page, $pageArray);

// If so, include it, if not, emit error.
if ($inArray == true) {
    include('pages/'. $page .'.php');
}else {
    include('pages/home.php');
}
