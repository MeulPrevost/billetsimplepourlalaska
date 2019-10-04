<?php
namespace OCFram;
//Gestionnaire du formulaire qui traite le formulaire une fois qu'il a été envoyé. Il a besoin de savoir de quel formulaire il s'agit, connaitre le manager correspondant à l'entité et savoir si le formulaire a bien été envoyé pour le traiter.
 
class FormHandler
{
  protected $form;
  protected $manager;
  protected $request;
 
  public function __construct(Form $form, Manager $manager, HTTPRequest $request)
  {
    $this->setForm($form);
    $this->setManager($manager);
    $this->setRequest($request);
  }
 
  public function process()
  {
    if($this->request->method() == 'POST' && $this->form->isValid())
    {
      $this->manager->save($this->form->entity());
 
      return true;
    }
 
    return false;
  }
 
  public function setForm(Form $form)
  {
    $this->form = $form;
  }
 
  public function setManager(Manager $manager)
  {
    $this->manager = $manager;
  }
 
  public function setRequest(HTTPRequest $request)
  {
    $this->request = $request;
  }
}