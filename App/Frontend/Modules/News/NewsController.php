<?php
namespace App\Frontend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');
 
    // On récupère le manager des news.
    $manager = $this->managers->getManagerOf('News');
 
    $listeNews = $manager->getList(0, $nombreNews);
 
    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $news->setContenu($debut);
      }
    }
 
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listeNews', $listeNews);
  }
 
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
 
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }
 
    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
  }
 
  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  /////////////////////////////////////////A SUPPRIMER SI MARCHE PAS
  //On veut que quand la personne clique sur signaler un commentaire la bdd soit modifiée dans la colonne signalement. Un texte apparait pour prévenir que la personne a bien signalée et ces commentaires remontent dans frontend/index.

  public function executeUpdateSignalementComment(HTTPRequest $request)
  {
    // On récupère l'id du commentaire pour savoir quel commentaire on va modifier.
    $comment_id = $request->getData('id');
    // On récupère le commentaire avec l'ID récupérer
    $comment = $this->managers->getManagerOf('Comments')->get($comment_id);

    //On teste si le commentaire est bien récupéré (si l'id du commentaire existe), sinon on envoie une 404
    if ( $comment === false )
    {
      $this->app->httpResponse()->redirect404();
    }

    //On a créé la fonction setSignalement dans Entity/Comment pour lui passer la main comme on n'a pas le droit d'y accéder (privé). On lui demande de passer le boleen à true.
    //La variable comment contient un objet qui a ses attributs. On lui change l'attibut signalement en true.
    $comment->setSignalement('1');

    //On sauvegarde ensuite le nouvel objet avec la nouvelle valeur de signalement (on envoit l'info sur la bdd)
    $this->managers->getManagerOf('Comments')->save($comment);

    $this->app->httpResponse()->redirect('news-'.$comment->news().'.html');
  }
  //FIN SUPPRIMER SI MARCHE PAS
}