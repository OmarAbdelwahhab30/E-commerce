<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class AdminCategoryModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function RegisterCategory($data)
    {
        $this->db->query('INSERT INTO categ (categname,description,visibility,allowcomment,allowAds) 
                VALUES(:categname,:description , :visibility,:allowcomment,:allowAds)');
        $this->db->bindValues(':categname', $data['categname']);
        $this->db->bindValues(':description', $data['categdesc']);
        $this->db->bindValues(':visibility', $data['visibility']);
        $this->db->bindValues(':allowcomment', $data['comments']);
        $this->db->bindValues(':allowAds', $data['ads']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function GetAllCategories()
    {
        $this->db->query("SELECT * FROM categ where allowAds = :allowAds");
        $this->db->bindValues(":allowAds","yes");
        $this->db->execute();
        if ($this->db->rowCount()>0){
            return $this->db->resultSet();
        }
        return array();
    }
    public function DeleteCategory($categoryID){
        $this->db->query("Delete FROM categ WHERE categid=:categid");
        $this->db->bindValues(":categid",$categoryID);
        if ($this->db->execute())
        {
            return true;
        }
        return false;
    }

    public function GetCategory($categoryID){
        $this->db->query("SELECT * FROM categ WHERE categid = :categid");

        $this->db->bindValues(":categid",$categoryID);

        $this->db->execute();

        if ($this->db->rowCount()>0){
            return $this->db->single();
        }
        return array();
    }

    public function UpdateCategory($data,$categoryID)
    {
        $this->db->query('UPDATE categ SET categname = :categname , description = :description
                 ,visibility = :visibility,
                allowcomment = :allowcomment , allowAds = :allowAds
                WHERE categid =:categid');

        $this->db->bindValues(':categname', $data['categname']);
        $this->db->bindValues(':description', $data['categdesc']);
        $this->db->bindValues(':visibility', $data['visibility']);
        $this->db->bindValues(':allowcomment', $data['comments']);
        $this->db->bindValues(':allowAds', $data['ads']);
        $this->db->bindValues(':categid', $categoryID);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}