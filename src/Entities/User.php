<?php
namespace Entities;
class User
{   private $_id;
    private $_email;
    private $_password;
    private $_role;

 
//################################################################
    public function __construct(array $ligne)
    {
        $this->hydrate($ligne);
    }
    public function hydrate(array $ligne)
    {
        foreach ($ligne as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function __toString(): string
    {
        return "ID = ".$this->getId() ." - EMAIL = ". $this->getEmail() ." - PASSWORD = ". $this->getPassword() ." - ROLE =". $this->getRole() . "<br/>";
        }
//################################################################
    public function getId()
    {
        return $this->_id;
    }
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

//################################################################
    public function getEmail()
    {
        return $this->_email;
    }
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }
//################################################################
    public function getPassword()
    {
        return $this->_password;
    }
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }
//################################################################
    public function getRole()
    {
        return $this->_role;
    }
    public function setRole($role)
    {
        $this->_role = $role;
        return $this;
    }
//################################################################
}
