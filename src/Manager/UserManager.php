<?php
namespace Biviall\ComposerTp\Manager;

use PDO;
use Biviall\ComposerTp\Entities\User;

include "../vendor/autoload.php";

class UserManager{

    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db) : UserManager
    {
        $this->_db = $db;
        return $this;
    }
    public function add(User $user):bool
    {
        $query = $this->_db->prepare('INSERT INTO users (email,`password`,`role`) VALUES (:email,:password,:role);');
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':role', $user->getRole());
        return $query->execute();
    }
    public function delete(User $user):bool
    {
        $query = $this->_db->prepare('DELETE FROM `users`WHERE id=:id;');
        $query->bindValue(':id', $user->getId());
        return $query->execute();
        
    }
    public function getOne(int $id)
    {
        $sth = $this->_db->prepare('SELECT * FROM USERS WHERE id = ?');
        $sth-> execute(array($id));
        $ligne = $sth->fetch();
        $user = new User($ligne);  
        return $user; 
    }
    public function getAll():array
    {
        $listeUsers = array();
        $request = $this->_db->query('SELECT * FROM users;');
        while($ligne = $request->fetch(PDO::FETCH_ASSOC))
         {
            $perso = new User($ligne);
            $listeUsers[] = $perso;

         }
         return $listeUsers;
    }
    public function update(User $user):bool
    {
            $query = $this->_db->prepare("UPDATE users SET email = :email, password = :password , role = :role WHERE id =:id;");
            $query->bindValue(':id', $user->getId());
            $query->bindValue(':email', $user->getEmail());
            $query->bindValue(':password', $user->getPassword());
            $query->bindValue(':role', $user->getRole());
            return $query->execute();
    }
}
?>