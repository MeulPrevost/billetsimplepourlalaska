<!-- Page d'administration de modification des articles. -->

<!-- Image bandeau loup -->
<img class="loupRedim" alt="Loup" src="../images/loupredim.png">

<!-- Retourne message erreur si le login et mdp ne sont pas bons ou case du formulaire mal remplies. -->

<!-- Formulaire avec mise en place de l'éditeur de texte tinymce. -->
<script src='https://cdn.tiny.cloud/1/5dwxp344ptoeezyi1lgwgsk1ih2n2ucip8gtl5pmemf9czld/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script>
	tinymce.init({
	selector: '.form-news textarea'
  	});
</script>

<h2>Modifier une news</h2>
<form class="form-news" action="" method="post">
	<p>
		<?= $form ?>
		<input type="submit" value="Modifier" />
	</p>
</form>