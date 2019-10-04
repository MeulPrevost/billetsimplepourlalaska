<?php
namespace App\Frontend;
//Classe représentant l'application Frontend, classe fille de Application. Cette classe à la différence du Backend n'est sécurisée par mot de passe elle est accessible à tous.
 
use \OCFram\Application;
 
class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
 
    $this->name = 'Frontend';
  }
 
  public function run()
  {
    $controller = $this->getController();
    $controller->execute();
 
    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}