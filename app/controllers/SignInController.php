<?php


namespace PHPMVC\controllers;


use PHPMVC\lib\AbstractController;

class SignInController extends AbstractController
{

    private $InModel ;

    public function __Construct()
    {
        $this->InModel = $this->Model("SignInModel");
    }

    public function index()
    {
        $data = [
            'username' => '',
            'password' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
            ];

            if (empty($data['username']) || empty($data['password'])) {
                $_SESSION['alert'] = 'Please complete password and username fields';

                header('location:'.URLROOT."SignInController/index");
                exit();
            }


            //Check if all errors are empty
            if (empty($_SESSION['alert'])) {
                $UserloggedIn = $this->InModel->CheckUserAndReturn($data['username'], md5($data['password']));

                if ($UserloggedIn) {
                    IndexController::createUserSession($UserloggedIn);
                } else {
                    $_SESSION['alert'] = 'Password or username is incorrect. Please try again.';
                    header('location:'.URLROOT."SignInController/index");
                    exit();
                }
                //Check if this is a normal user or admin
                if ($this->isAdmin()==true) {
                    header('location:'.URLROOT."IndexController/default");
                    exit();
                } else {
                    header('location:'.URLROOT."IndexController/default");
                    exit();
                }
            }
        }
        else{
            $this->Route("GoIn/signin");
        }
    }

//    /**************************  AJAX SECTION ***************************/
//
//    public function IsFoundUsername($username)
//    {
//        $bool = $this->InModel->IsFoundUsername($username);
//        echo json_encode($bool);
//    }
//
//    public function UsernameVsPassword($username,$password)
//    {
//        $bool = $this->InModel->UsernameVsPassword($username,md5($password));
//        echo json_encode($bool);
//    }
}