<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require("includes/_head.php"); ?>
    <title><?= $title ?></title>
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