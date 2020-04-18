<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Favicon -->
    <link href="/public/images/favicon.png" rel="icon" type="image/png"/>
    <!-- Css files -->
    <link href="/public/css/styleError.css" rel="stylesheet"/>
    <!--Viewport -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <title>Error <?= $code ?></title>
</head>
<body class="error">
<section id="notfound">
    <div class="notfound">
        <div class="notfound-page">
            <h1>Oops!</h1>
        </div>
        <h2><?= $code . ' - ' . $message ?></h2>
        <p></p>
        <a href="/home">Revenir à l'accueil</a>
    </div>
</section>
</body>
</html>
