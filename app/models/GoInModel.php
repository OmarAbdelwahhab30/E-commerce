<?php
namespace PHPMVC\models;

use PHPMVC\LIB\Database;

class GoInModel
{

    public function __construct()
    {
        $this->db = new Database();
    }

    public function CheckUserLogin($username,$password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username AND password = :password');

        $this->db->bindValues(':username',$username);

        $this->db->bindValues(':password',$password);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->single();
        }else{
            return false;
        }
    }

}