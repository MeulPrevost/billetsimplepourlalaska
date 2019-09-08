<?php
namespace OCFram;
//Cette première ligne contient la déclaration d'un namespace.
//Ce fichier définit la requête du client et ce qu'on lui retourne. Les fonctionnalités suivantes sont mises en place : obtenir un cookie, obtenir une variable get, obtenir une variable post, obtenir la méthode employée pour envoyer la requête (méthode get ou post), obtenir l'URL d'entrée (utile pour que le routeur puisse savoir quelle page est souhaitée, comme par exemple quel post affiché selon son id).
 
class HTTPRequest extends ApplicationComponent
{
  public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }
 
  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }
 
  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }
 
  public function getExists($key)
  {
    return isset($_GET[$key]);
  }
 
  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }
 
  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }
 
  public function postExists($key)
  {
    return isset($_POST[$key]);
  }
 
  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
}