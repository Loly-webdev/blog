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
    $server = $_SERVER["REQUEST_URI"];
    $serverData = trim(parse_url($server, PHP_URL_PATH),"/");
    $params = explode('/', $serverData);
    $page = reset($params);

    if ('' != $page) {
        require('pages/'. $page .'.php');
    } else {
        echo "error !";
    }
    ?>
</main>
<!-- Footer -->
<footer>
    <?php require("includes/_footer.php"); ?>
</footer>
</body>
</html>
