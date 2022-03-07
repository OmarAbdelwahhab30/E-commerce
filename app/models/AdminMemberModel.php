<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class AdminMemberModel
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function ReturnCustomer($userid)
    {
        $this->db->query("SELECT * FROM users WHERE userid = :userid");

        $this->db->bindValues(":userid",$userid);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->single();
        }else{
            return false;
        }
    }

    public function DeleteMember($MemeberID)
    {
        $this->db->query("DELETE FROM users WHERE userid = :userid");

        $this->db->bindValues(":userid",$MemeberID);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }

    public function ChangeRole($memberID,$role)
    {
        $this->db->query("UPDATE users SET roles = :roles WHERE userid =:userid");

        $this->db->bindValues(":userid",$memberID);

        $this->db->bindValues(":roles",$role);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }
    public function IsValidUsername($username,$userid)
    {
        $this->db->query('SELECT username FROM users WHERE username = :username AND userid <> :userid');

        $this->db->bindValues(':username', $username);

        $this->db->bindValues(':userid', $userid);

        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return false;
        }
        return true;
    }

    public function EditCustomerInfo($CustomerInfo,$userid)
    {
        $this->db->query("UPDATE users SET username = :username , email = :email , dob = :dob ,truststatus = :truststatus WHERE userid =:userid");

        $this->db->bindValues(":username",$CustomerInfo['username']);

        $this->db->bindValues(":email",$CustomerInfo['email']);

        $this->db->bindValues(":dob",$CustomerInfo['dob']);

        $this->db->bindValues(':truststatus',$CustomerInfo['truststatus']);

        $this->db->bindValues(":userid",$userid);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }

    public function ChangeBanning($memberID,$status)
    {
        $this->db->query("UPDATE users SET Blocked = :Blocked WHERE userid =:userid");

        $this->db->bindValues(":userid",$memberID);

        $this->db->bindValues(":Blocked",$status);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }

    public function GetPendingMembers()
    {
        $this->db->query("SELECT * FROM users WHERE regstatus = :regstatus AND roles <> :roles");

        $this->db->bindValues(":regstatus",0);

        $this->db->bindValues(":roles",1);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->resultSet();
        }else{
            return array();
        }
    }

    public function ActivateUser($userid){
        $this->db->query("UPDATE users SET regstatus = :regstatus WHERE userid =:userid");

        $this->db->bindValues(":userid",$userid);

        $this->db->bindValues(":regstatus",1);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }

}