<!-- Page d'administration des articles. -->

<!-- Image bandeau loup -->
<img class="loupRedim" alt="Loup" src="../images/loupredim.png">

<h2>CHAPITRES</h2>
<p class="texteIntro" style="text-align: center">Il y a actuellement <?= $nombreNews ?> chapitres. En voici la liste (vous pouvez les modifier ou les supprimer).<br>Attention toute suppression est définitive !</p>

<!-- Tableau des articles publiés. -->
<table>
	<tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th class="colonneDateModif">Dernière modification</th><th>Action</th></tr>
<?php

//Affiche ligne par ligne des articles présents en bdd.
foreach ($listeNews as $news) :
	?>
	<tr>
		<td><?= $news['auteur'] ?></td>
		<td><?= $news['titre'] ?></td>
		<td>le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></td>
		
		<?php if ($news['dateAjout'] == $news['dateModif']) : ?> 
			<td class="colonneDateModif">-</td>
		<?php else : ?>
			<td class="colonneDateModif"> le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></td>
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