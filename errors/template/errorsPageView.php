<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Favicon -->
    <link href="/public/images/favicon.png" rel="icon" type="image/png"/>
    <!-- Css files -->
    <link href="/public/css/styleError.css" rel="stylesheet"/>
    <!-- Css Bootstrap -->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Viewport responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/d40212f998.js" crossorigin="anonymous"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <!-- Title -->
    <title>Error <?= $code ?></title>
</head>
<body class="bg-light p-0 m-0">
<section id="notfound">
    <div class="notfound">
        <div class="notfound-page pt-4">
            <h1 class="mt-4">Oops!</h1>
        </div>
        <h2 class="py-4"><?= $code . ' - ' . $message ?></h2>
        <p></p>
        <a href="/home">Revenir à l'accueil</a>
    </div>
</section>
</body>
</html>
