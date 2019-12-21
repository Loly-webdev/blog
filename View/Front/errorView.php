<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require PROJECT_VIEW . "Partial/_head.php"; ?>
    <?php $title = 'Error'; ?>
</head>
<body>
<main>
    <section>
        <strong>
            <p>
                Franchement, déchirer une page web, c'est pas sérieux !
                <br>
            </p>
        </strong>
        <img alt="Page d'erreur" src="../../Public/images/error_code.jpg">
        <p>
            <br>
            <strong>
                Détail de l'erreur :
            </strong>
            <?php echo $error; ?>
        </p>
    </section>
</main>
</body>
</html>
