<!DOCTYPE html>
<html lang="fr">
<head>
    <title>connexion</title>
    <?php include("../includes/_head.php"); ?>
</head>
<body>
<header>
    <?php include("../includes/_nav.php"); ?>
</header>
<main>
    <!-- Contact form -->
    <section id="contact">
        <h3>Contactez-moi :</h3>
        <form class="flex" action="#" id="contact_infos" method="post">
            <label class="space" for="login">Identifiant :</label>
            <input class="space" id="login" name="login" placeholder="Identifiant" type="text"/>
            <label class="space" for="pass">Mot de passe (8 caractères minimum) :</label>
            <input class="space" id="pass" name="pass" placeholder="Mot de passe" type="password" minlength="8" required/>
            <input class="button" type="submit" value="Connexion"/>
        </form>
    </section>
</main>
<!-- Footer -->
<footer>
    <?php include("../includes/_footer.php"); ?>
</footer>
</body>
</html>
