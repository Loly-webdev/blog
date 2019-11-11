<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require(PROJECT_ROOT . "includes/_head.php"); ?>
    <title><?= $title ?></title>
</head>

<body>
<header>
    <?php require(PROJECT_ROOT . "includes/_nav.php"); ?>
</header>
<!-- Contenu du corps de la page-->
<main>
    <?= $content ?>
</main>
<!-- Footer -->
<footer>
    <?php require(PROJECT_ROOT . "includes/_footer.php"); ?>
</footer>
</body>
</html>