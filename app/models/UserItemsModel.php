<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class UserItemsModel
{


    private Database $db;


    public function __Construct()
    {
        $this->db = new Database();
    }


    public function GetItemsCategory($CAT_ID)
    {
        $this->db->query("SELECT * FROM items WHERE categid = :categid AND approve = :approve");
        $this->db->bindValues(":categid",$CAT_ID);
        $this->db->bindValues(":approve","1");
        $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            return $this->db->resultSet();
        }
        return false;
    }


    public function GetItem($ITEM_ID)
    {
        $this->db->query("SELECT * FROM items WHERE itemid=:itemid");
        $this->db->bindValues(":itemid",$ITEM_ID);
        $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            return $this->db->single();
        }
        return false;
    }

    public function GetItemComments($itemid)
    {
        $this->db->query("SELECT * FROM comments WHERE itemid=:itemid");
        $this->db->bindValues(":itemid",$itemid);
        $this->db->execute();

        if ($this->db->rowCount() > 0)
        {
            return $this->db->resultSet();
        }
        return false;

    }

}