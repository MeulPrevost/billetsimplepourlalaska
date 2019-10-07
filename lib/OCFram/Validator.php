<?php
namespace OCFram;
//Valide les données du formulaire. Un validateur ne peut valider qu'une contrainte. Exemple : si l'on veut vérifier qu'une valeur est nulle et qu'elle ne dépasse pas les 50 caractères, il y aura besoin de deux validateurs. Il y a donc une classe de base Validator et autant de classes filles que l'on souhaite. Dans notre projet NotNullValidator et MaxLength Validator et MailValidator.
 
abstract class Validator
{
  protected $errorMessage;
 
  public function __construct($errorMessage)
  {
    $this->setErrorMessage($errorMessage);
  }
 
  abstract public function isValid($value);
 
  public function setErrorMessage($errorMessage)
  {
    if (is_string($errorMessage))
    {
      $this->errorMessage = $errorMessage;
    }
  }
 
  public function errorMessage()
  {
    return $this->errorMessage;
  }
}