<?php $title = 'Mon blog'; ?>

<h2>Derniers billets du blog :</h2>

<?php
foreach ($posts as $post)
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em><a href="/post/id=<?= $post['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}



