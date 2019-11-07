<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $title ?></title>
    <?php require("includes/_head.php"); ?>
</head>

<body>
<header>
    <?php require("includes/_nav.php"); ?>
</header>
<!-- Contenu du corps de la page-->
<main id="home">
    <?= $content ?>
</main>
<!-- Footer -->
<footer>
    <?php require("includes/_footer.php"); ?>
</footer>
</body>
</html>