<?php
namespace OCFram;
//Classe fille de Field.
 
class StringField extends Field
{
  protected $maxLength;
 
  public function buildWidget()
  {
    $widget = '';
 
    $widget .= '<label>'.$this->label.'</label><input type="text" name="'.$this->name.'"';
 
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
 
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    $widget .= ' />';

    if (!empty($this->errorMessage))
    {
      $widget .= '<br /><div class="rouge">'.$this->errorMessage.'</div>';
    }
    return $widget;
  }
 
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
 
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}