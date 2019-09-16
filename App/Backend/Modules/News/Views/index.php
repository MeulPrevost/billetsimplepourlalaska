<h2>ADMINISTRATION DES CHAPITRES</h2>
<p class="intro-front" style="text-align: center">Il y a actuellement <?= $nombreNews ?> chapitres. En voici la liste (vous les modifier ou les supprimer).<br>Attention toute suppression est définitive !</p>
 
<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($listeNews as $news) :
	?>
	<tr>
		<td><?= $news['auteur'] ?></td>
		<td><?= $news['titre'] ?></td>
		<td>le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></td>
		
		<?php if ($news['dateAjout'] == $news['dateModif']) : ?> 
			<td>-</td>
		<?php else : ?>
			<td> le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></td>
		<?php endif; ?>

		<td>	
			<a href="news-update-<?= $news['id'] ?>.html">
				<img src="/images/update.png" alt="Modifier" />
			</a> 
			<a href="news-delete-<?= $news['id'] ?>.html" onclick="return confirm('Etes vous sûr ?');">		<img src="/images/delete.png" alt="Supprimer" />
			</a>
		</td>
	</tr>
<?php endforeach; ?>

</table>