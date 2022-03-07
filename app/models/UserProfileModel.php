<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class UserProfileModel
{
    private $db;
    public function __Construct()
    {
        $this->db = new Database();
    }

    public function GetUserProducts($userid)
    {
        $this->db->query('SELECT * FROM items WHERE userid = :userid AND approve = :approve  ');

        $this->db->bindValues(':userid',$userid);
        $this->db->bindValues(":approve","1");

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->resultSet();
        }
        return false;

    }
}