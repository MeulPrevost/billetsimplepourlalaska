<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\User;
 
abstract class UsersManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un utilisateur.
   * @param $user Utilisateur à ajouter
   * @return void
   */
  abstract protected function add(User $user);
 
  /**
   * Méthode permettant de supprimer un utilisateur.
   * @param $id L'identifiant utilisateur à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode permettant de voir si le pseudo existe.
   * @param $pseudo
   * @return bool|User
   */
  abstract public function getUserIfExistBy($pseudo);
 
  /**
   * Méthode permettant de récupérer liste des utilisateurs.
   * @param $user Les utilisateurs
   * @return array
   */
  abstract public function getList($debut, $limit);

   /**
   * Méthode permettant d'enregistrer un user sur la bdd.
   * @param $user User User à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(User $user)
  {
    if ($user->isValid())
    {
      $user->isNew() ? $this->add($user) : $this->modify($user);
    }
    else
    {
      throw new \RuntimeException('Le nouvel utilisateur doit être validée pour être enregistrée');
    }
  }
}