<?php


namespace PHPMVC\models;


use PHPMVC\lib\Database;
use PHPMVC\lib\Paginator;

class IndexModel
{

    public Database $db;
    private $FromWhichRecord;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function GetUserInfo($username)
    {
        $this->db->query('SELECT userid ,username ,email,dob,roles,truststatus,regstatus,blocked,RegDate,img
                                FROM users WHERE username = :username');

        $this->db->bindValues(':username', $username);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        }
        return false;
    }

    public  function CountTableRows($tablename,$ColumnName,$condition)
    {
        $this->db->query("SELECT count($ColumnName) AS count FROM $tablename WHERE $condition ");

        $this->db->execute();

        if ($this->db->rowCount() > 0 ){
            return $this->db->single();
        }
        return 0;
    }

    public function GetLatest($tablename,$colsName,$condition,$order,$limit){
        $this->db->query("SELECT $colsName  FROM $tablename  WHERE $condition   ORDER BY $order  LIMIT $limit   ");

        $this->db->execute();

        if ($this->db->rowCount() > 0 ){
            return $this->db->resultSet();
        }
        return 0;
    }

    public function PaginationHelper($TableName,$FromWhichRecord,$JoinInfo =array())
    {
        $this->FromWhichRecord = $FromWhichRecord;
        // if there is no join
        if ($JoinInfo['Join'] == false) {
            $this->db->query(" SELECT " .$JoinInfo['ColsName']. " FROM $TableName "." WHERE ".$JoinInfo['where']. " LIMIT ". ":FromWhichRecord" . ',' . ":RECORDS_PER_PAG");

            $this->db->bindValues(":FromWhichRecord",$FromWhichRecord);
            $this->db->bindValues(":RECORDS_PER_PAG",Paginator::RECORDS_PER_PAGE);

            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                return $this->db->resultSet();
            }
            return 0;
        }else{
            return $this->JoinHelper($JoinInfo);
        }
    }

    public function JoinHelper($JoinInfo)
    {

        // join between 2 tables
        if ($JoinInfo['table3'] == "" ){
            $this->db->query("SELECT " .$JoinInfo['ColsName']. " FROM ". $JoinInfo['table1']."
                                   INNER JOIN ".$JoinInfo['table2']." ON ".$JoinInfo['cond1']." WHERE ".$JoinInfo['where']."      
                                  LIMIT " . ":FromWhichRecord " . "," . " :RECORDS_PER_PAGE");
            $this->db->bindValues(":FromWhichRecord",$this->FromWhichRecord);
            $this->db->bindValues(":RECORDS_PER_PAGE",Paginator::RECORDS_PER_PAGE);
            $this->db->execute();
            if ($this->db->rowCount() > 0 ){
                return $this->db->resultSet();
            }
            return 0 ;
        }else{
            //join multi tables

            $this->db->query("SELECT ".$JoinInfo['ColsName']." FROM ". $JoinInfo['table1']."
                                  INNER JOIN ".$JoinInfo['table2']." ON ".$JoinInfo['cond1']."      
                                  INNER JOIN ".$JoinInfo['table3']." ON ".$JoinInfo['cond2']. " WHERE ".$JoinInfo['where']." 
                                   LIMIT :FromWhichRecord , :RECORDS_PER_PAGE");


            $this->db->bindValues(":FromWhichRecord",$this->FromWhichRecord);
            $this->db->bindValues(":RECORDS_PER_PAGE",Paginator::RECORDS_PER_PAGE);
            $this->db->execute();
            if ($this->db->rowCount() > 0) {
                return $this->db->resultSet();
            }
            return 0;
        }
    }

    public function GetAllCategories()
    {
        $this->db->query("SELECT categname,categid,allowcomment FROM categ where visibility = :visibility");
        $this->db->bindValues(":visibility","yes");
        $this->db->execute();
        if ($this->db->rowCount() > 0){
            return $this->db->resultSet();
        }
        return false;
    }
}