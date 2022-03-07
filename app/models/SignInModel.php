<?php


namespace PHPMVC\models;


use PHPMVC\lib\Database;

class SignInModel
{

    private $db;
    public function __Construct()
    {
        $this->db = new Database();
    }

    public function IsFoundUsername($username)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bindValues(":username",$username);
        $this->db->execute();
        if ($this->db->rowCount() == 1){
            return true;
        }
        return false;
    }
    public function UsernameVsPassword($username,$password)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username AND password = :password");
        $this->db->bindValues(":username",$username);
        $this->db->bindValues(":password",$password);
        $this->db->execute();
        if ($this->db->rowCount() == 1){
            return true;
        }
        return false;
    }

    public function CheckUserAndReturn($username,$password)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username AND password = :password");
        $this->db->bindValues(":username",$username);
        $this->db->bindValues(":password",$password);
        $row = $this->db->single();

        if ($this->db->rowCount() == 1){
            return $row;
        }
        return false;
    }
}