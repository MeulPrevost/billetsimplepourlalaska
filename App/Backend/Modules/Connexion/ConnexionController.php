<?php
namespace App\Backend\Modules\Connexion;
//Controleur du module connexion (pour se connecter et gérer les utilisateurs.) Ce sont les routes qui assigne un module et une action à une URL.
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\User;
use \FormBuilder\UserFormBuilder;
use \OCFram\FormHandler;
 
class ConnexionController extends BackController
{
  //Fonction qui permet de se connecter
  public function executeIndex(HTTPRequest $request)
  {
    if ($request->postExists('pseudo')) {

      $pseudo = $request->postData('pseudo');
      //  Récupération de l'utilisateur et de son pass hashé
      $resultat = $this->managers->getManagerOf('Users')->getUserIfExistBy($pseudo);

      if ($resultat) {
        $password = $request->postData('pass');
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

        if ($isPasswordCorrect) {
          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('.');
        } else {
          $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
        }
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
    //Création de la variable title qui me permet de récupérer le titre de ma page.
    $this->page->addVar('title', 'Connexion');
  }

  //Fonction qui permet de se déconnecter
  public function executeLogout(HTTPRequest $request)
  {
    $this->app->user()->setAuthenticated(false);
    $this->app->httpResponse()->redirect('/');
  }

  //Fonction qui permet d'insérer un utilisateur
  public function executeInsertUser(HTTPRequest $request)
  {

    $this->page->addVar('title', 'Administrer les utilisateurs');

    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $user = new User([
        'pseudo' => $request->postData('pseudo'),
        'pass' => $request->postData('pass'),
        'mail' => $request->postData('mail')
      ]);
      // $this->managers->getManagerOf('Users')->save($user);
 
    } else {
      //Création du nouvel utilisateur
      $user = new User;
    }

    //Définition du formulaire présent dans la page
 
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
   
  //Fonction qui permet de supprimer un utilisateur 
  public function executeDeleteUser(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Users')->delete($request->getData('id'));

    $this->app->user()->setFlash('L\'utilisateur a bien été supprimé, merci !');
 
    $this->app->httpResponse()->redirect('/admin/new-user.html');
  }
}