<?php
namespace OCFram;
//Classe fille de Validator.
 
class NotNullValidator extends Validator
{
	public function isValid($value)
  	{
    	return $value != '';
  	}
}