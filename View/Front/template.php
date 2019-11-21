<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require(PROJECT_VIEW . "Partial/_head.php"); ?>
    <title><?= $title ?></title>
</head>

<body>
<header>
    <?php require(PROJECT_VIEW . "Partial/_nav.php"); ?>
</header>
<!-- Contenu du corps de la page-->
<main>
    <?php echo $content; ?>
</main>
<!-- Footer -->
<footer>
    <?php require(PROJECT_VIEW . "Partial/_footer.php"); ?>
</footer>
</body>
</html>