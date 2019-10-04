<?php
namespace OCFram;
//La classe Field est capable de renvoyer le code html répresentant le champs et de vérifier si la valeur du champs est valide. 
//La classe possède une méthode hydrate() qui lui permet de s'hydrater (chaque champs a en effet ses spécificités ). C'est le trait Hydrator dans Hydrator.php qu'utilise la classe pour s'hydrater.
//La class est composée d'un attribut stockant le message d'erreur associé au champ, d'un attribut stockant le nom du champ, d'un attribut stockant la valeur du champs, d'un constructeur demandant la liste des attributs avec leur valeur afin d'hydrater l'objet, d'une méthode abstraite chargée de renvoyer le code HTML du champ, d'une méthode permettant de savoir si le champ est valide ou non. On créé deux classes filles StringField et Textfield dans deux autres fichiers. On créé aussi dans le constructeur de l'objet fiedl la liste des validateurs que l'on veut imposer aux champs.
 
abstract class Field
{
  use Hydrator;
 
  protected $errorMessage;
  protected $label;
  protected $name;
  protected $validators = [];
  protected $value;
 
  public function __construct(array $options = [])
  {
    if (!empty($options))
    {
      $this->hydrate($options);
    }
  }
 
  abstract public function buildWidget();

  // Attribut stockant le message d'erreur associé au champ.
  public function isValid()
  {
    foreach ($this->validators as $validator)
    {
      if (!$validator->isValid($this->value))
      {
        $this->errorMessage = $validator->errorMessage();
        return false;
      }
    }
 
    return true;
  }

  //Attribut stockant le label du champ
  public function label()
  {
    return $this->label;
  }
 
  //Attribut stockant la longueur du champs
  public function length()
  {
    return $this->length;
  }
 
  //Attribut stockant le nom du champs
  public function name()
  {
    return $this->name;
  }
 
  //
  public function validators()
  {
    return $this->validators;
  }
 
  //Attribut stockant la valeur du champs
  public function value()
  {
    return $this->value;
  }
 
  public function setLabel($label)
  {
    if (is_string($label))
    {
      $this->label = $label;
    }
  }
 
  public function setLength($length)
  {
    $length = (int) $length;
 
    if ($length > 0)
    {
      $this->length = $length;
    }
  }
 
  public function setName($name)
  {
    if (is_string($name))
    {
      $this->name = $name;
    }
  }
 
  public function setValidators(array $validators)
  {
    foreach ($validators as $validator)
    {
      if ($validator instanceof Validator && !in_array($validator, $this->validators))
      {
        $this->validators[] = $validator;
      }
    }
  }
 
  public function setValue($value)
  {
    if (is_string($value))
    {
      $this->value = $value;
    }
  }
}