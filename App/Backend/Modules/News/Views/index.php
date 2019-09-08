<p style="text-align: center">Il y a actuellement <?= $nombreNews ?> chapitres. En voici la liste (vous les modifier ou les supprimer) Attention toute suppression est définitive !</p>
 
<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeNews as $news)
{
  echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="news-update-', $news['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="news-delete-', $news['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>

</table>
<br>
<br>

<h2>ADMINISTRATION DES COMMENTAIRES</h2>

<p style="text-align: center">Voici les commentaires publiés votre blog. Les commentaires signalés sont en premiers et un 1 dans la colonne signalement (les surligner en rouge - cacher la colonne signalement une fois que vérifié que OK). Vous pouvez les supprimer ou les modifier. Attention toute suppression est définitive.<br>
Note : quand l'admin modifie la valeur de signalement passe à NULL.</p> 

<table>
  <tr><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>Signalé</th><th>Action</th></tr>

<?php
echo "on va essayer de trier par ordre décroissant colonne signalement";

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
	echo '<tr><td>', $comment['auteur'], '</td><td>', $comment['contenu'], '</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td>', $comment['signalement'],'</td><td><a href="comment-update-', $comment['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="comment-delete-', $comment['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n"; 
}

//CHANGER LA COULEUR DE LA LIGNE EN ROUGE SI SIGNALEMENT = 1.

//A SUPPRIMER (version antérieure qui fonctionnait bien)
//foreach ($comments as $comment)
//{
  //echo '<tr><td>', $comment['auteur'], '</td><td>', $comment['contenu'], '</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td>', $comment['signalement'],'</td><td><a href="comment-update-', $comment['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="comment-delete-', $comment['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";

  //On veut que si 1 la ligne se surligne en rouge
  //if ($comment['signalement'] == '1')
  	//{
  		//$comment['signalement'] == 'SSS';
  	//}

//
?>

</table>