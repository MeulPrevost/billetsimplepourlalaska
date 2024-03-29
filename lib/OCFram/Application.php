<?php
namespace OCFram;
//Class qui définit l'application, elle a deux classes filles : BackendApplication et FrontendApplication.
//On définit dans HTTP.request.php et HTTP.reponse.php comment représenter la requète et ce que nous devons lui envoyer en réponse. La class Application a une fonctionnalité : son nom et plusieurs caractéristiques : son nom, la requête du client et la réponse à lui envoyer.
//Chaque classe répresentant une application hérite de cette classe Application, il n'est donc pas nécessaire d'instancier cette classe (créer un objet). Cela signifie donc que cette classe est abstraite.
 
abstract class Application
{
  protected $httpRequest;
  protected $httpResponse;
  protected $name;
  protected $user;
  protected $config;
 
  public function __construct()
  {
    $this->httpRequest = new HTTPRequest($this);
    $this->httpResponse = new HTTPResponse($this);
    $this->user = new User($this);
    $this->config = new Config($this);
  
    //Valeur nulle à l'attribut name. Chaque application qui héritera de cette classe sera chargée de spécifier son nom en initialisant cette attribut.
    $this->name = '';
  }
 
  public function getController()
  {
    $router = new Router;
 
    $xml = new \DOMDocument;
    $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');
 
    $routes = $xml->getElementsByTagName('route');
 
    // On parcourt les routes du fichier XML.
    foreach ($routes as $route)
    {
      $vars = [];
 
      // On regarde si des variables sont présentes dans l'URL.
      if ($route->hasAttribute('vars'))
      {
        $vars = explode(',', $route->getAttribute('vars'));
      }
 
      // On ajoute la route au routeur.
      $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
    }
 
    try
    {
      // On récupère la route correspondante à l'URL.
      $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
    }
    catch (\RuntimeException $e)
    {
      if ($e->getCode() == Router::NO_ROUTE)
      {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $this->httpResponse->redirect404();
      }
    }
 
    // On ajoute les variables de l'URL au tableau $_GET.
    $_GET = array_merge($_GET, $matchedRoute->vars());
 
    // On instancie le contrôleur.
    $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
    return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
  }
 
  abstract public function run();
 
  public function httpRequest()
  {
    return $this->httpRequest;
  }
 
  public function httpResponse()
  {
    return $this->httpResponse;
  }
 
  public function name()
  {
    return $this->name;
  }
 
  public function config()
  {
    return $this->config;
  }
 
  public function user()
  {
    return $this->user;
  }
}