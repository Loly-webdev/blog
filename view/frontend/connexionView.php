<?php $title = 'Connexion'; ?>

<!-- Contact form -->
<section>
    <h3>Connexion :</h3>
    <form class="flex" action="#" method="post">
        <label class="space" for="login">Identifiant :</label>
        <input class="space" id="login" name="login" placeholder="Identifiant" type="text"/>
        <label class="space" for="pass">Mot de passe (8 caractères minimum) :</label>
        <input class="space" id="pass" name="pass" placeholder="Mot de passe" type="password" minlength="8" required/>
        <input class="button" type="submit" value="Connexion"/>
    </form>
</section>