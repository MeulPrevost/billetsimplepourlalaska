<!-- Cette vue définit la page de gestion des users accessibles dans le backoffice. -->

<!-- Image bandeau loup -->
<img class="loupRedim" alt="Loup" src="../images/loupredim.png">

<h2>UTILISATEURS</h2>
<p class="texteIntro">Vous pouvez sur cette page gérer les utilisateurs de votre blog. Ajoutez un nouvel utilisateur en remplissant le formulaire ou supprimer un utilisateur dans la liste.</p>

<!-- Formulaire pour ajouter un user. Dans ce projet les formulaires sont externalisés à l'aide d'une API pour qu'ils puissent être utilisés une infinité de fois, et faciliter la création. L'objet Form représente le formulaire, qui n'est d'autre qu'une liste de champs. Tous les champs des formulaires sont des objets, ils héritent tous de la classe Field. Le contenu des champs est validé grâce à la classe Validator et ses classes filles. La classe FormBuilder est chargée de construire un formulaire et ses filles précisent les spécificités de chacun des formulaires. Le controlleur exécute ensuite le formulaire de son choix. Ici le formulaire d'ajout de user. -->

<!-- Retourne message erreur si le login et mdp ne sont pas bons ou case du formulaire mal remplies. -->
<?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
<form action="" method="post">
	<?= $form ?>
	<input type="submit" value="Ajouter" />
</form>


<!-- Affichage du tableau de gestion des users. -->
<table>
	<tr><th>Pseudo</th><th>Adresse mail</th><th class="colonneDateAjout">Date d'ajout</th><th>Action</th></tr>
<?php

//Affiche tous les users.
foreach ($users as $tmp_user) :
	?>
	<tr>
		<td><?= $tmp_user['pseudo'] ?></td>
		<td><?= $tmp_user['mail'] ?></td>
		<td class="colonneDateAjout"><?= $tmp_user['dateAjout']->format('d/m/Y à H\hi') ?></td>
		<td>	
			<a href="user-delete-<?= $tmp_user['id'] ?>.html" onclick="return confirm('Etes vous sûr ?');">		<img src="/images/delete.png" alt="Supprimer" />
			</a>
		</td>
	</tr>
<?php endforeach; ?>

</table>




 