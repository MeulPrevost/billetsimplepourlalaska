<h2>ADMINISTRATION DES COMMENTAIRES</h2>

<p style="text-align: center">Voici les commentaires publiés votre blog. Les commentaires signalés sont en premiers et un 1 dans la colonne signalement (les surligner en rouge - cacher la colonne signalement une fois que vérifié que OK). Vous pouvez les supprimer ou les modifier. Attention toute suppression est définitive.<br>
Note : quand l'admin modifie la valeur de signalement passe à NULL.</p> 

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

foreach ($comments as $comment) 
{
	//list($auteur, $contenu, $date, $signalement) = array_values($tall_signalement);
	echo '<tr><td>', $comment['auteur'], '</td><td>', $comment['contenu'], '</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td>', $comment['signalement'],'</td><td><a href="comment-update-', $comment['id'], '.html"><img src="/images/update.png" alt="Accepter" /></a> <a href="comment-delete-', $comment['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n"; 
}

?>

</table>