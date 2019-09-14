<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Billet simple Alaska' ?>
    </title>
 
    <meta charset="utf-8" />
 
    <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
  </head>
 
  <body>

    <div id="wrap">
      <header>
        <h1><a href="/">Billet simple pour l'Alaska</a></h1>
        <p><br>Reconnectez-vous à votre propre nature...</p>
      </header>
 
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          <?php if ($user->isAuthenticated()) { ?>
          <li><a href="/admin/news-insert.html">Ajouter un chapitre</a></li>
          <li><a href="/admin/">Administration des chapitres</a></li>
          <li><a href="/admin/comments-admin.html">Administration des commentaires</a></li>
          
          <?php } ?>
        </ul>
      </nav>
 
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>
 
      <footer>
        <p><a href="http://billetsimplepourlalaska/admin/">Admin</a><br>Copyright: MeulPrevost2019</p>
      </footer>
    </div>
  </body>
</html>