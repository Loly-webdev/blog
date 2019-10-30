<!DOCTYPE html>
<html lang="fr">
<head>
    <title>article</title>
    <?php include("../includes/_head.php"); ?>
</head>
<body>
<header>
    <?php include("../includes/_nav.php"); ?>
</header>
<main>
    <article>
        <h2>Titre de l'article</h2>
        <p>Phrase d'accroche</p>
        <p>Contenu de l'article</p>
        <aside>
            <div>Auteur de l'article</div>
            <p>Date de modification de l'article :
                <time>17/10/2019</time>
            </p>
        </aside>
    </article>
    <form class="flex" action="#" method="post">
        <h3>Commentaires :</h3>
        <label for="name">Votre nom :</label>
        <input id="name" name="name" placeholder="Nom" type="text"/>
        <label for="message">Votre commentaire :</label>
        <textarea id="message" name="message" placeholder="Message" rows="9"></textarea>
        <input class="button" type="submit" value="Envoyer"/>
    </form>
    <section>liste des commentaires.</section>
    <section>
        <h4>Liens de retour :</h4>
        <a href="blog.php">Retour au blog</a>
        <a href="../index.php">Retour à l'acceuil</a>
    </section>
</main>
<footer>
    <?php include("../includes/_footer.php"); ?>
</footer>
</body>
</html>
