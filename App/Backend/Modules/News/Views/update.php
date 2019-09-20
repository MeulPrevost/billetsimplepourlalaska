<img class="loupRedim" alt="Loup" src="../images/loupredim.png">
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