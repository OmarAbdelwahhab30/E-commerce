<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class AdminItemsModel
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetUserData($username){
        $this->db->query("SELECT * FROM users WHERE username =:username");

        $this->db->bindValues(":username",$username);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->single();
        }
        return false;
    }

    public function RegisterItem($data)
    {
        $this->db->query('INSERT INTO items (name,description,price,add_date,country_made,status,categid,userid,img,approve) 
                VALUES(:name,:description,:price,NOW(),:country_made,:status,:categid,:userid,:img,:approve)');
        $this->db->bindValues(':name', $data['itemname']);
        $this->db->bindValues(':description', $data['itemdesc']);
        $this->db->bindValues(':price', intval($data['price']));
        $this->db->bindValues(':country_made', $data['country']);
        $this->db->bindValues(':status', $data['status']);
        $this->db->bindValues(':categid', $data['category']);
        if ($_SESSION['roles'] == "1") {
            $this->db->bindValues(':userid', $data['userid']);
        }else{
            $this->db->bindValues(':userid', $_SESSION['userid']);
        }
        $this->db->bindValues(':img', $data['img']);
        if ($_SESSION['roles'] == "1") {
            $this->db->bindValues(':approve', "1");
        }else {
            $this->db->bindValues(':approve', "0");
        }
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function DeleteItem($ItemID){
        $this->db->query("Delete FROM items WHERE itemid=:itemid");
        $this->db->bindValues(":itemid",$ItemID);
        if ($this->db->execute())
        {
            return true;
        }
        return false;
    }

    public function ApproveItem($ItemID)
    {
        $this->db->query('UPDATE items SET approve = 1 WHERE itemid =:itemid');

        $this->db->bindValues(':itemid', $ItemID);

        if ($this->db->execute()){
            return true;
        }
        return false;
    }
    public function GetItem($ItemID){
        $this->db->query("SELECT * FROM items WHERE itemid = :itemid");

        $this->db->bindValues(":itemid",$ItemID);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->single();
        }
        return array();
    }

    public function UpdateItem($data,$itemid)
    {
        $this->db->query('UPDATE items SET `name` = :name , description = :description ,price = :price,
                country_made = :country_made , status = :status, userid = :userid , categid = :categid,img=:img
                WHERE itemid =:itemid');

        $this->db->bindValues(':name', $data['itemname']);
        $this->db->bindValues(':description', $data['itemdesc']);
        $this->db->bindValues(':price', $data['price']);
        $this->db->bindValues(':country_made', $data['country']);
        $this->db->bindValues(':status', $data['status']);
        $this->db->bindValues(':userid', $data['userid']);
        $this->db->bindValues(':categid', $data['category']);
        $this->db->bindValues(':img', $data['img']);

        $this->db->bindValues(':itemid',$itemid);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}