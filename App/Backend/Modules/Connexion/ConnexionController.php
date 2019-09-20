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
 
    if ($request->postExists('pseudo')) {

      $login = $request->postData('pseudo');
      $password = $request->postData('pass');
      //  Récupération de l'utilisateur et de son pass hashé
      $db = new \PDO('mysql:host=localhost;dbname=unbilletpourlalaska', 'root', '');
      $req = $db->prepare('SELECT id, pass FROM users WHERE pseudo = :pseudo');
      //$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $pseudo = $_POST['pseudo'];
      $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  
      $req->execute(array(
        'pseudo' => $pseudo));
      $resultat = $req->fetch();
  
      // Comparaison du pass envoyé via le formulaire avec la base
      $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);
      
      if ($resultat) {
        if ($isPasswordCorrect) {

          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('.');
        } else {
          $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
        }
      } else {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect. 2');
      }
    }
  }

  public function executeLogout(HTTPRequest $request)
  {
    $this->app->user()->setAuthenticated(false);
    $this->app->httpResponse()->redirect('/');
  }

  public function executeInsertUser(HTTPRequest $request)
  {

    $this->page->addVar('title', 'Administrer les utilisateurs');

    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $user = new User([
        'pseudo' => $request->postData('pseudo'),
        'pass' => password_hash($request->postData('pass'), PASSWORD_DEFAULT),
        'mail' => $request->postData('mail')
      ]);
      $this->managers->getManagerOf('Users')->save($user);
    }
    $user = new User;
 
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
 
    $this->app->httpResponse()->redirect('/admin/new-user.html');
  }
}