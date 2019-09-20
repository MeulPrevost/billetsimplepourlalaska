<img class="loupRedim" alt="Loup" src="../images/loupredim.png">
<h2>UTILISATEURS</h2>
<p class="texteIntro">Vous pouvez sur cette page gérer les utilisateurs de votre blog. Ajoutez un nouvel utilisateur en remplissant le formulaire ou supprimer un utilisateur dans la liste.</p>
<form action="" method="post">
    <?= $form ?>
 
    <input type="submit" value="Ajouter" />
</form>

<table>
  <tr><th>Pseudo</th><th>Adresse mail</th><th>Date d'ajout</th><th>Action</th></tr>
<?php

foreach ($users as $tmp_user) :
	?>
	<tr>
		<td><?= $tmp_user['pseudo'] ?></td>
		<td><?= $tmp_user['mail'] ?></td>
		<td><?= $tmp_user['dateAjout']->format('d/m/Y à H\hi') ?></td>
		<td>	
			<a href="user-delete-<?= $tmp_user['id'] ?>.html" onclick="return confirm('Etes vous sûr ?');">		<img src="/images/delete.png" alt="Supprimer" />
			</a>
		</td>
	</tr>
<?php endforeach; ?>

</table>




 