<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

