<?php
namespace Model;
 
use \Entity\User;
 
class UsersManagerPDO extends UsersManager
{
  protected function add(User $user)
  {
    $requete = $this->dao->prepare('INSERT INTO users SET pseudo = :pseudo, pass = :pass, mail = :mail, dateAjout = NOW()');
 
    $requete->bindValue(':pseudo', $user->pseudo());
    $requete->bindValue(':pass', $user->pass());
    $requete->bindValue(':mail', $user->mail());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, pseudo, pass, mail, dateAjout FROM users ORDER BY id DESC';
 
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
 
    $users = $requete->fetchAll();
 
    foreach ($users as $user)
    {
      $user->setDateAjout(new \DateTime($user->dateAjout()));
    }
 
    $requete->closeCursor();
 
    return $users;
  }
 
  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, pseudo, pass, mail, dateAjout FROM users WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
 
    if ($user = $requete->fetch())
    {
      $user->setDateAjout(new \DateTime($user->dateAjout()));
 
      return $users;
    }
 
    return null;
  }

}