<?php
namespace App\Backend;

//Cette classe à la différence du frontend est sécurisée. Seules les personnes identifiées y ont accès. Dans le cours on parle de la méthode run() qu'est ce que c'est ?
 
use \OCFram\Application;
 
//La classe hérite de la classe Application et prend le nom de Backend.
class BackendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Backend';
  }
 
  public function run()
  {
    if ($this->user->isAuthenticated())
      //Si l'utilisateur est identifié on obtient le controleur grâce à la méthode parente getController)
    {
      $controller = $this->getController();
    }
    else
      //Sinon on a l'instanciation du controleur du module de connexion/
    {
      $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
    }
    
    //On exécute le controleur
    $controller->execute();

    //On assigne la page créée par le controleur à la réponse
    $this->httpResponse->setPage($controller->page());
    //On envoie la réponse
    $this->httpResponse->send();
  }
}