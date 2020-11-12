<!DOCTYPE html>
<html lang="fr">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Favicon -->
    <link href="/public/images/favicon.png" rel="icon" type="image/png"/>
    <!-- Css files -->
    <link href="/public/css/style.css" rel="stylesheet"/>
    <!-- Css Bootstrap -->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Viewport responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/d40212f998.js" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Error</title>
</head>
<body class="p-0">
<main class="mx-4 mb-4 p-2 text-center">
    <div class="container-fluid mx-auto">
        <h3 class="text-uppercase font-weight-bold text-info">Franchement, déchirer une page web, c'est pas sérieux !
        </h3>
        <img alt="Page d'erreur" src="/public/images/error_code.jpg">
        <h3 class="text-info">Détail de l'erreur : </h3>
        <p class="h4 p-2">
            <span class="p-2 text-secondary font-weight-bold">Type ou code de l'erreur : </span>
            <?= $type ?>
            <br>
            <span class="p-2 text-secondary font-weight-bold">Message : </span>
            <?= $message ?>
            <br>
            <span class="p-2 text-secondary font-weight-bold">Fichier : </span>
            <?= $file ?>
            <br>
            <span class="p-2 text-secondary font-weight-bold">Ligne : </span>
            <?= $line ?>
        </p>
    </div>
</main>
<footer class="fixed-bottom bg-dark text-secondary text-center">
    <a href="/home" class="m-2 p-2 btn btn-primary">
        <span class="fas fa-angle-double-left"></span>
        Retour à l'accueil
    </a>
    <!-- script jquery -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
            crossorigin="anonymous">
    </script>
    <!-- script bootstrap -->
    <script type="text/javascript" src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</footer>
</body>
</html>
