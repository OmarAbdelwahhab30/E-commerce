<?php


namespace PHPMVC\models;


use PHPMVC\lib\Database;

class SignUpModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function IsValidUsername($username)
    {
        $this->db->query('SELECT username FROM users WHERE username = :username');

        $this->db->bindValues(':username', $username);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return false;
        }
        return true;
    }

    //To register new user to database

    public function RegisterUser($UserData,$RegStatus)
    {
        $this->db->query('INSERT INTO users (username, password,email,dob,regstatus,img) VALUES(:username,:password ,:email, :dob,:regstatus,:img)');
        $this->db->bindValues(':username', $UserData['username']);
        $this->db->bindValues(':password', $UserData['password']);
        $this->db->bindValues(':email', $UserData['email']);
        $this->db->bindValues(':dob', $UserData['dob']);
        $this->db->bindValues(':regstatus', $RegStatus);
        $this->db->bindValues(':img', $UserData['img']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function IsUsernameDuplicated($username)
    {
        $this->db->query('SELECT username FROM users WHERE username = :username  ');

        $this->db->bindValues(':username',$username);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return true;
        }
        return false;
    }


}