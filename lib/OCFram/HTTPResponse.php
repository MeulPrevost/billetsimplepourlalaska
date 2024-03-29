<?php
namespace OCFram;
//Ce fichier définit la réponse envoyée au client. Nous souhaitons assigner une page à la réponse, envoyer la réponse en générant la page, rediriger l'utilisateur, le rediriger vers une erreur 404 si la page n'existe pas, ajouter un cookies, et ajouter un header spécifique selon l'utilisateur (reconnu grâce au cookie).
 
class HTTPResponse extends ApplicationComponent
{
  protected $page;
 
  public function addHeader($header)
  {
    header($header);
  }
 
  public function redirect($location)
  {
    header('Location: '.$location);
    exit;
  }
 
  public function redirect404()
  {
    $this->page = new Page($this->app);
    $this->page->setContentFile(__DIR__.'/../../Errors/404.html');
 
    $this->addHeader('HTTP/1.0 404 Not Found');
 
    $this->send();
  }
 
  public function send()
  {
    exit($this->page->getGeneratedPage());
  }
 
  public function setPage(Page $page)
  {
    $this->page = $page;
  }
 
  // Changement par rapport à la fonction setcookie() : le dernier argument est par défaut true alors quelle est false sur la fonction setcookie() de la bibliothèque standart de PHP. Il s'agit d'une sécurité qu'il vaut mieux activer.
  public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
  }
}