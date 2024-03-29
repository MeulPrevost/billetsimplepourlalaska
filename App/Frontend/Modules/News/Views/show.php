<!-- Page d'un chapitre. -->

<!-- Affiche l'auteur et les infos de l'article. nl2br permet d'ajouter un retour à la ligne. -->
<p>Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<div><?= nl2br($news['contenu']) ?></div>
 
<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>

  <?php } ?>
<!-- Affiche les commentaires déjà existants et propose d'en ajouter un nouveau. -->

<div class="espaceCommentaires">

  <p><a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
 
  <?php
  if (empty($comments))
  {
  ?>
  <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
  <?php
  }
 
  foreach ($comments as $comment)
  {
  ?>
  <fieldset>
    <legend>
      Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
      <?php //ICI PARAMETRER LE FAIT QUE QUAND UN ARTICLE EST SIGNALE ENVOI VALEUR 1 A LA BB POUR LA CASE SIGNALEMENT - Afficher ensuite les articles signalés dans l'admin en affichant un point d'exclamation rouge dans la case signalé.
      ?>
        <?php if ($comment->signalement() === '1') { ?>
          Ce commentaire a été signalé.
        <?php } else { ?>
          <a href="/comment-update-signalement-<?= $comment['id'] ?>.html">Cliquez ici pour signaler le commentaire</a>
        <?php } ?>
      <?php if ($user->isAuthenticated()) { ?>
        <a href="/admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
        <a href="/admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
      <?php } ?>
    </legend>
    <div><?= nl2br(htmlspecialchars($comment['contenu'])) ?></div>
  </fieldset>
  <?php
  }
  ?>
 
  <p><a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
</div>