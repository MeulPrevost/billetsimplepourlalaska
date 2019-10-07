<!-- Page de connexion (celle que l'on voit quand on arrive sur l'espace admin pour définir notre login et notre mot de passe). -->

<!-- Image bandeau loup -->
<img class="loupRedim" alt="Loup" src="../images/loupredim.png">

<h2>Connexion</h2>
<!-- Retourne message erreur si le login et mdp ne sont pas bons ou cases du formulaire mal remplies.-->
<?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>

<!-- Formulaire -->
<form action="" method="post">
	<label>Pseudo</label>
	<input type="text" name="pseudo" value="" /><br />
	<label>Mot de passe</label>
	<input type="password" name="pass" /><br /><br />

	<input type="submit" value="Connexion" />
</form>