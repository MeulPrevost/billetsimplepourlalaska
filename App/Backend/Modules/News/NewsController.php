<?php
namespace App\Backend\Modules\News;
//Controleur du module news du back (pour gérer les news et les commentaires associés). Ce sont les routes qui assigne un module et une action à une URL.
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\User;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \FormBuilder\UserFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  //Fonction qui permet de supprimer un article
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
 
    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
 
    $this->app->httpResponse()->redirect('.');
  }
 
  //Fonction qui permet de supprimer un commentaire
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->httpResponse()->redirect('/admin/comments-admin.html');
  }
 
  //Fonction qui permet d'administrer les chapitres
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Administrer les chapitres');
 
    $manager = $this->managers->getManagerOf('News');

    $this->page->addVar('listeNews', $manager->getList());
    $this->page->addVar('nombreNews', $manager->count());
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getList());
  }

  //Fontion qui permet d'administrer les commentaires
  public function executeAdminComments(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Administrer les commentaires');
 
    $manager = $this->managers->getManagerOf('News');

    $this->page->addVar('listeNews', $manager->getList());
    $this->page->addVar('nombreNews', $manager->count());
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getList());
  }
 
  //Fonction qui permet d'insérer un article
  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajouter un chapitre');

  }
 
  //Fonction qui permet de modifier un article
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'un chapitre');

  }
 
  //Fonction qui permet de modifier un commentaire
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
 
      $this->app->httpResponse()->redirect('/admin/comments-admin.html');

    }
 
    $this->page->addVar('form', $form->createView());
  }
  
  //Fonction qui permet de gérer les commentaires
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }
 
    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
 
    if ($formHandler->process())
    {
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

}