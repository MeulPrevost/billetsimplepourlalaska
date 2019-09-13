 <?php
 ///////////////////////////TEST TINYMCE
 ?>

 <script src='https://cdn.tiny.cloud/1/5dwxp344ptoeezyi1lgwgsk1ih2n2ucip8gtl5pmemf9czld/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
  <script>
  tinymce.init({
    selector: '.form-news textarea'
  });
  </script>

<?php
 ///////////////////////////FIN TEST TINYMCE
 ?>


<h2>Ajouter une news</h2>
<form class="form-news" action="" method="post">
    <?= $form ?>
 
    <input type="submit" value="Ajouter" />
</form>