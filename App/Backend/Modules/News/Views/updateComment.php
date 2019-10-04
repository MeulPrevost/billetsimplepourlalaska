<!-- Page modification formulaire. -->

<!-- Image bandeau loup -->
<img class="loupRedim" alt="Loup" src="../images/loupredim.png">

<h2>COMMENTAIRES</h2>
<!-- Retourne message erreur si le login et mdp ne sont pas bons ou case du formulaire mal remplies. -->
<?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

<!-- Formulaire modification commentaire. -->
<form action="" method="post">
  <p>
    <?= $form ?>
 
    <input type="submit" value="Modifier" />
  </p>
</form>