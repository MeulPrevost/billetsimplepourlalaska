<?php
namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\User;
use \FormBuilder\UserFormBuilder;
use \OCFram\FormHandler;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
 
      if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass'))
      {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }

  public function executeInsertUser(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $user = new User([
        'pseudo' => $request->postData('pseudo'),
        'pass' => $request->postData('pass'),
        'mail' => $request->postData('mail')
      ]);
    }
    else
    {
      $user = new User;
    }
    $this->page->addVar('title', 'Gestion des utilisateurs');
 
    $formBuilder = new UserFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();

    $managerUsers = $this->managers->getManagerOf('Users');
 
    $formHandler = new FormHandler($form, $managerUsers, $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le nouvel utilisateur a bien été ajouté, merci !');
 
     $this->app->httpResponse()->redirect('/admin/new-user.html');
    }
 
    $this->page->addVar('users', $managerUsers->getList());
    $this->page->addVar('form', $form->createView());
  }

  public function executeDeleteUser(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Users')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Utilisateur supprimé !');
 
    $this->app->httpResponse()->redirect('/admin/new-user.html');
  }
}