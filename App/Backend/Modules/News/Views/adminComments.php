<img class="loupRedim" alt="Loup" src="../images/loupredim.png">
<h2>COMMENTAIRES</h2>


<p class="texteIntro">Voici les commentaires publiés votre blog. Les commentaires signalés remontent en premiers. Vous pouvez les supprimer ou les modifier. Attention toute suppression est définitive.
</p> 

<table>
  <tr><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>Signalé</th><th>Action</th></tr>

<?php

//On veut que les commentaires signalés apparaissent en premier.
//tuto https://www.zendevs.xyz/comment-trier-les-tableaux-en-php/ 
//Les informations sur chaque commentaires sont stockés dans leur propre tableau dans le tableau principal $comments. La fonction storey_sort() permet de classer par ordre décroissant. La fonction usort permet de trier les valeurs dans un tableau multidimensionnel basé sur un champ particulier.
function storey_sort($comment_a, $comment_b){
	return $comment_b['signalement'] - $comment_a['signalement'];
}

usort($comments, "storey_sort");

foreach ($comments as $comment) :
	//list($auteur, $contenu, $date, $signalement) = array_values($tall_signalement);
	?>
	<tr>
		<td><?= $comment['auteur'] ?></td>
		<td><?= $comment['contenu'] ?></td>
		<td>le <?= $comment['date']->format('d/m/Y à H\hi') ?></td>
		<?php if ( $comment['signalement'] === '1' ) : ?>
			<td>Oui!!</td>
		<?php else : ?>
			<td>Non :)</td>
		<?php endif; ?>
		<td>
			<a href="comment-update-<?= $comment['id'] ?>.html">
				<img src="/images/update.png" alt="Accepter" />
			</a>
			<a href="comment-delete-<?= $comment['id'] ?>.html" onclick="return confirm('Etes vous sûr ?');">
				<img src="/images/delete.png" alt="Supprimer" />
			</a>
		</td>
	</tr>
<?php endforeach; ?>
</table>