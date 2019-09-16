<div class="wrapper-banner">

    <img id="imageHeader" alt="Couverture Billet simple pour l'Alaska" src="images/loup.png">

    <p id="baseline">La nouvelle oeuvre magistrale de Jean Forteroche<br><br>Pour la première fois en exclusivité en ligne</p>

</div>

<p class="intro-front">Chaque mois, Jean Forteroche mettra en ligne un chapitre de son nouveau roman Billet Simple pour l'Alaska.<br><br>Cliquez sur le chapitre pour y accéder dans son intégralité.<br><br>Bon voyage !</p>

<?php
foreach ($listeNews as $news)
{
?>
  	<h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  	<p class="chapitre"><?= strip_tags(nl2br($news['contenu'])) ?></p>
  	<img alt="picto-flocon" id="picto-flocon" src="images/snowflakes">
<?php
}