<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $title = 'Error'; ?>
    <meta charset="UTF-8">
    <!-- Favicon -->
    <link href="../../Public/images/favicon.png" rel="icon" type="image/png"/>
    <!-- Css files -->
    <link href="../../Public/css/style.css" rel="stylesheet"/>
    <!--Viewport -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Meta description -->
    <meta content="Mon blog professionnel" name="description">
    <meta content="Eloïse RUIZ-RODRIGUEZ" name="author">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap|Roboto|Open+Sans" rel="stylesheet">
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
            <br>
        </p>
        <p>
            <a href="/home">Retour à l'Accueil</a>
        </p>
    </section>
</main>
</body>
</html>