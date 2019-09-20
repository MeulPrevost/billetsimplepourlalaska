<h2>UTILISATEURS</h2>
<p class="texteIntro">Vous pouvez sur cette page gérer les utilisateurs de votre blog. Ajoutez un nouvel utilisateur en remplissant le formulaire ou supprimer un utilisateur dans la liste.</p>
<form action="" method="post">
    <?= $form ?>
 
    <input type="submit" value="Ajouter" />
</form>


<?php 
// Vérification de la validité des informations 
//Si le formulaire est rempli alors il envoie les données sinon il ne fait rien
if ( sizeof($_POST) ) {
	$bdd = new PDO('mysql:host=localhost;dbname=unbilletpourlalaska;charset=utf8', 'root', '');
	
	// Hachage du mot de passe
	$email = $_POST['email'];
	$pseudo = $_POST['pseudo'];
	$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	// Insertion
	$req = $bdd->prepare('INSERT INTO `users`(`pseudo`, `pass`, `mail`) VALUES (:pseudo, :pass, :email)');
	$req->execute(array(
		'pseudo' => $pseudo,
	    'pass' => $pass_hache,
	    'email' => $email)
	);

	echo 'Le nouvel utilisateur a bien été ajouté !';	
}

?>

<table>
  <tr><th>Pseudo</th><th>Adresse mail</th><th>Action</th></tr>
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




 