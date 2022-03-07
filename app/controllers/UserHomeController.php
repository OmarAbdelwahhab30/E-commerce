<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\models\IndexModel;

class UserHomeController extends AbstractController
{

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("UserHomeModel");
        $this->IndexModel  = $this->Model("IndexModel");
    }

    public function index()
    {
        if (isset($_SESSION['blocked']) && $_SESSION['blocked'] == "0") {
            $data = $this->PrepareHome();
            $this->Route("UserStore/index",$data);

        } elseif(isset($_SESSION['blocked']) && $_SESSION['blocked'] == "1") {
            $this->Route("UserStore/block");
        }else{
            $data = $this->PrepareHome();
            $this->Route("UserStore/index",$data);
        }
    }

    public function PrepareHome()
    {
        $no_total_users            = $this->IndexModel->CountTableRows("users","userid","roles !=1");
        $no_total_Items = $this->IndexModel->CountTableRows("items","itemid",1);
        $no_total_Comments = $this->IndexModel->CountTableRows("comments","commentid",1);

        $data = [
            'totalUsers'                => $no_total_users->count,
            'no_total_Items'            =>$no_total_Items->count,
            'no_total_comments'         =>$no_total_Comments->count,
        ];
        return $data ;
    }


    public function PendingUser()
    {
        $User = $this->IndexModel->GetUserInfo($_SESSION['username']);
        IndexController::CreateUserSession($User);
        if ($User->regstatus == "1") {
            header("Location:" . URLROOT . "IndexController/default");
        } else {
            $this->Route("UserStore/pendinguser");
        }
    }
}