<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class UserFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Pseudo',
        'name' => 'pseudo',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le pseudo spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le pseudo du nouvel utilisateur'),
          //CET UTILISATEUR EXISTE DEJA MERCI D'EN MENTIONNER UN AUTRE
        ]
       ]))
       ->add(new StringField([
        'label' => 'Pass',
        'name' => 'pass',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('Le mot de passe est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier le mot de passe du nouvel utilisateur'),
        ]
       ]))
       ->add(new StringField([
        'label' => 'Mail',
        'name' => 'mail',
        'maxLength' => 50,
        'validators' => [
          new NotNullValidator('Merci de spécifier le mail du nouvel utilisateur'),
        ]
       ]));
  }
}