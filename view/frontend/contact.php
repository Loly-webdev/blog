<?php $title = 'Contact'; ?>

<?php ob_start(); ?>
<!-- Contact form -->
<section id="contact">
    <h3>Contactez-moi :</h3>
    <form class="flex" action="#" method="post">
        <label for="name">Nom :</label>
        <input id="name" name="name" placeholder="Nom" type="text"/>
        <label for="email">E-mail :</label>
        <input id="email" name="email" placeholder="Email" type="email"/>
        <label for="subject">Sujet :</label>
        <input id="subject" name="subject" placeholder="Sujet" type="text"/>
        <label for="message">Message :</label>
        <textarea id="message" name="message" placeholder="Message" rows="9"></textarea>
        <input class="button" type="submit" value="Envoyer !"/>
    </form>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
