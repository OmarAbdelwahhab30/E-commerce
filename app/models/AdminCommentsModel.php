<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class AdminCommentsModel
{

    public Database $db ;
    public function __Construct()
    {
        $this->db = new Database();
    }

    /**
     *
     */
    public function RemoveComment($CommentID)
    {
       $this->db->query("DELETE  FROM comments WHERE commentid = :commentid ");

       $this->db->bindValues(":commentid",$CommentID);

       if ($this->db->execute()){
           return true;
       }
       return false;
    }

    public function EditComment($comment,$id)
    {
        $this->db->query("Update comments set comment = :comment WHERE commentid = :commentid ");

        $this->db->bindValues(":commentid",$id);

        $this->db->bindValues(":comment",$comment);

        if ($this->db->execute()){
            return true;
        }
        return false;

    }

   public function AddComment($userid,$itemid,$comment)
   {
       $this->db->query('INSERT INTO comments (comment,date,itemid,userid) 
                VALUES(:comment,NOW(),:itemid,:userid)');
       $this->db->bindValues(':comment', $comment);
       $this->db->bindValues(':itemid', $itemid);
       $this->db->bindValues(':userid', $userid);

       if ($this->db->execute()) {
           return true;
       } else {
           return false;
       }
   }

}