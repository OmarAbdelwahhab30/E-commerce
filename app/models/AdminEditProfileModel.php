<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class AdminEditProfileModel
{


    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }




    public function IsUsernameDuplicated($username,$UserID)
    {

        $this->db->query('SELECT username FROM users WHERE username = :username AND userid != :userid');

        $this->db->bindValues(':username',$username);

        $this->db->bindValues(':userid',$UserID);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return true;
        }
    }

    public function IsOldPasswordTrue($userid)
    {
        $this->db->query("SELECT password FROM users WHERE userid = :userid ");

        $this->db->bindValues(":userid",$userid);

        $this->db->execute();
        if ($this->db->rowCount()>0){
            return $this->db->single()->password;
        }
        return false;
    }

    public function UpdatedData($UserData)
    {
        $this->db->query("UPDATE users SET username =:username, password =:password ,email=:email, dob = :dob,img=:img
                                WHERE userid = :userid");
        $this->db->bindValues(':username',$UserData['username']);

        $this->db->bindValues(':password',$UserData['newpassword']);

        $this->db->bindValues(':email',$UserData['email']);

        $this->db->bindValues(':dob',$UserData['dob']);

        $this->db->bindValues(':img',$UserData['img']);

        $this->db->bindValues(':userid',$_SESSION['userid']);

        if ($this->db->execute() == true){
            return true;
        }
        return false;
    }

    public function DeleteImage()
    {
        $this->db->query("UPDATE users SET img=:img WHERE userid = :userid");

        $this->db->bindValues(":img",DS.'assets'.DS.'img'.DS.STATIC_IMAGE);

        $this->db->bindValues(':userid',$_SESSION['userid']);

        if ($this->db->execute() == true){
            return true;
        }
        return false;

    }
}