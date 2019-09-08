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

<p style="text-align: center">Voici les commentaires publiés votre blog. Les commentaires signalés ont un point d'exclamation. Vous pouvez les supprimer ou les modifier. QUAND LA PERSONNE CLIQUE SUR MODIFIER OU SUPPRIMER PENSER A REMETTRE LA VALEUR DE SIGNALEMENT A 0.</p> 

<table>
  <tr><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>Signalé</th><th>Action</th></tr>

<?php
foreach ($comments as $comment)
{
  echo '<tr><td>', $comment['auteur'], '</td><td>', $comment['contenu'], '</td><td>', $comment['signalement'],'</td><td>le ', $comment['date']->format('d/m/Y à H\hi'), '</td><td><a href="comment-update-', $comment['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="comment-delete-', $comment['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>

</table>