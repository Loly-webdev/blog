<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Favicon -->
    <link href="/public/images/favicon.png" rel="icon" type="image/png"/>
    <!-- Css files -->
    <link href="/public/css/style.css" rel="stylesheet"/>
    <!--Viewport -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Error</title>
</head>
<body>
<main>
    <section>
        <h3>Franchement, déchirer une page web, c'est pas sérieux !</h3>
        <img alt="Page d'erreur" src="/public/images/error_code.jpg">
        <h3>Détail de l'erreur : </h3>
        <p>
            <strong>Type ou code de l'erreur : </strong>
            <?= $type ?>
            <br>
            <strong>Message : </strong>
            <?= $message ?>
            <br>
            <strong>Fichier : </strong>
            <?= $file ?>
            <br>
            <strong>Ligne : </strong>
            <?= $line ?>
        <hr>
        <a href="/">Retour à l'Accueil</a>
        </p>
    </section>
</main>
</body>
</html>
