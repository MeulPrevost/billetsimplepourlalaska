<?php
namespace Entity;
 
use \OCFram\Entity;
 
class User extends Entity
{
  protected $pseudo,
            $pass,
            $mail,
            $dateAjout;
 
  const PSEUDO_INVALIDE = 1;
  const PASS_INVALIDE = 2;
  const MAIL_INVALIDE = 3;
 
  public function isValid()
  {
    return !(empty($this->pseudo) || empty($this->pass) || empty($this->mail));
  }
 
 
  // SETTERS //
 
  public function setPseudo($pseudo)
  {
    if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::PSEUDO_INVALIDE;
    }
 
    $this->pseudo = $pseudo;
  }
 
  public function setPass($pass)
  {
    if (!is_string($pass) || empty($pass))
    {
      $this->erreurs[] = self::PASS_INVALIDE;
    }
 
    $this->pass = $pass;
  }
 
  public function setMail($mail)
  {
    if (!is_string($mail) || empty($mail))
    {
      $this->erreurs[] = self::MAIL_INVALIDE;
    }
 
    $this->mail = $mail;
  }
 
  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }
 
 
  // GETTERS //
 
  public function pseudo()
  {
    return $this->pseudo;
  }
 
  public function pass()
  {
    return $this->pass;
  }
 
  public function mail()
  {
    return $this->mail;
  }
 
  public function dateAjout()
  {
    return $this->dateAjout;
  }

}