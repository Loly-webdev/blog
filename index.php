<!DOCTYPE html>
<html lang="fr">
<head>
    <title>accueil</title>
    <?php require("includes/_head.php"); ?>
</head>
<body>
<header>
    <?php require("includes/_nav.php"); ?>
</header>
<!-- Contenu du corps de la page-->
<main id="home">
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
        require('pages/'. $page .'.php');
    } else {
        require('pages/home.php');
    }
    ?>
</main>
<!-- Footer -->
<footer>
    <?php require("includes/_footer.php"); ?>
</footer>
</body>
</html>