<?php
namespace OCFram;
// Permet d'obtenir l'application à laquelle l'objet appartient. La plupart des classes créés sont des composants de l'application et hérite de cette classe.
 
abstract class ApplicationComponent
{
	protected $app;
	public function __construct(Application $app)

	{
    	$this->app = $app;
  	}
 
  	public function app()
  	{
    	return $this->app;
  	}
}