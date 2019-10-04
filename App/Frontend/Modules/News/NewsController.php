<?php
namespace App\Frontend\Modules\News;
//Controleur du module news du front (pour permettre à l'utilisateur de lire les chapitres, les commenter ou signaler un commentaire.) Ce sont les routes qui assigne un module et une action à une URL.

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  //Fonction qui permet d'afficher la liste des chapitres déjà parus.
  public function executeIndex(HTTPRequest $request)
  {
    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Billet simple pour l\'Alaska');
 
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
  
  //Fonction qui permet d'affiche un article avec ses commentaires associés.
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
 
  //Fonction qui permet de faire un commentaire.
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

  ///Fonction qui permet le signalement d'un commentaire.
  //Quand un utilisateur clique sur "signaler un commentaire" la bdd soit modifiée dans la colonne signalement (le 0 se transforme en 1 si le commentaire est signalé). Un texte apparait alors à la fois sur le front pour prévenir que le commentaire est signalé.
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
    //La variable comment contient un objet qui a ses attributs. On lui change l'attibut signalement en 1.
    $comment->setSignalement('1');
    //On sauvegarde ensuite le nouvel objet avec la nouvelle valeur de signalement (on envoit l'info sur la bdd)
    $this->managers->getManagerOf('Comments')->save($comment);
    $this->app->httpResponse()->redirect('news-'.$comment->news().'.html');
  }
}