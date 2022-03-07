<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class UserCommentsController extends AbstractController
{

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("UserCommentsModel");
    }

    public function EditComment()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($this->ModelHelper->EditComment($_POST['Updatedcomment'],$_POST['commentid'])){
            $itemid = $_POST['itemid'];
            header("Location:".URLROOT."UserItemsController/Item/$itemid/1");
            exit();
        }
    }

    public function RemoveComment($commentID,$itemid)
    {
        if ($this->ModelHelper->RemoveComment($commentID))
        {
            header("Location:".URLROOT."UserItemsController/Item/$itemid/1");
            exit();
        }
    }

    public function AddComment($itemid,$userid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $comment = trim($_POST['comment']);
            if ($this->ModelHelper->AddComment($userid,$itemid,$comment)){
                header("Location:".URLROOT."UserItemsController/Item/".$itemid."/1");
                exit();
            }
        }
    }
}