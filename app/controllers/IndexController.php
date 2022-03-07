<?php


namespace PHPMVC\controllers;


use PHPMVC\lib\AbstractController;

class IndexController extends AbstractController
{

    /**
     * @var mixed
     */
    private $ModelHelper;

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("IndexModel");
    }
    public function default()
    {
        if (!($this->isLoggedIn())){
            header("Location:".URLROOT."OutHomeController/index");
            exit();
        }else{
            $this->GetAllCategories();
            if ($this->isAdmin()){
                header("Location:".URLROOT."AdminHomeController/HomeView");
            }else{
                if ($this->IsUserActivated()){
                    header("Location:".URLROOT."UserHomeController/index");
                    exit();
                }else{
                    header("Location:".URLROOT."UserHomeController/PendingUser");
                    exit();
                }
            }
        }
    }

    //to show all categories in sidebar
    public function GetAllCategories()
    {
       $AllCategories =  $this->ModelHelper->GetAllCategories();
       $_SESSION['categories'] = $AllCategories;
    }
    public static function CreateUserSession($data)
    {
        $_SESSION['userid'] = $data->userid;
        $_SESSION['username'] = $data->username;
        $_SESSION['email'] = $data->email;
        $_SESSION['dob'] = isset($data->dob)? $data->dob:null;
        $_SESSION['roles'] = $data->roles;
        $_SESSION['truststatus'] = $data->truststatus;
        $_SESSION['regstatus'] = $data->regstatus;
        $_SESSION['blocked']    =$data->blocked;
        $_SESSION['img']        =$data->img;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('location:'.URLROOT."IndexController/default");
        exit();

    }
}