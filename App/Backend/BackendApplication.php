<?php
namespace App\Backend;
//Classe représentant l'application Backend, classe fille de Application. Cette classe à la différence du frontend est sécurisée. Seules les personnes identifiées y ont accès.
 
use \OCFram\Application;
 
//la méthode _construct a pour rôle d'appeller le constructeur parent (la classe application) puis de spécifier le nom de l'application.
//La classe hérite de la classe Application et prend le nom de Backend.
class BackendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Backend';
  }

  //La méthode run obtient le contrôleur grâce à la méthode parente getController(), exécute le contrôleur, assigne la page créer par le contrôleur à la réponse et envoie la réponse.
  public function run()
  {
    if ($this->user->isAuthenticated())
      //Si l'utilisateur est identifié on obtient le controleur grâce à la méthode parente getController()
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