<?php
namespace OCFram;
//Classe fille de Validator.
 
class MailValidator extends Validator
{
  
  public function isValid($value)
  {
  	return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

}
