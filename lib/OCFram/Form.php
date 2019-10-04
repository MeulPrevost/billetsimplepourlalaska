<?php
namespace OCFram;
//L'objet Form est capable d'ajouter des champs à sa liste de champs, de générer le corps du formulaire afin que le contrôleur puisse les récupérer et les passer à la vue, et vérifier si tous les champs sont valides. 
//Tous les champs des formulaires sont des objets, ils héritent tous d'une même classe représentant leur nature en commun, à savoir la classe Field. -->
 
class Form
{
  protected $entity;
  protected $fields = [];
 
  public function __construct(Entity $entity)
  {
    $this->setEntity($entity);
  }
 
  public function add(Field $field)
  {
    $attr = $field->name(); // On récupère le nom du champ.
    $field->setValue($this->entity->$attr()); // On assigne la valeur correspondante au champ.
 
    $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
    return $this;
  }
 
  public function createView()
  {
    $view = '';
 
    // On génère un par un les champs du formulaire.
    foreach ($this->fields as $field)
    {
      $view .= $field->buildWidget().'<br />';
    }
 
    return $view;
  }
 
  public function isValid()
  {
    $valid = true;
 
    // On vérifie que tous les champs sont valides.
    foreach ($this->fields as $field)
    {
      if (!$field->isValid())
      {
        $valid = false;
      }
    }
 
    return $valid;
  }
 
  public function entity()
  {
    return $this->entity;
  }
 
  public function setEntity(Entity $entity)
  {
    $this->entity = $entity;
  }
}