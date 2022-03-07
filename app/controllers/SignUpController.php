<?php


namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\FileUploader;
class SignUpController extends AbstractController
{
    private $UPModel;
    private $IndexModel;

    public function __Construct()
    {
        $this->UPModel = $this->Model("SignUpModel");
        $this->IndexModel = $this->Model("IndexModel");
    }

    public function index()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'repassword' =>'',
            'dob' => ''
        ];

        $_SESSION['alert'] = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username'   => trim($_POST['username']),
                'email'      => trim($_POST['email']),
                'password'   => trim($_POST['password']),
                'repassword' => trim($_POST['repassword']),
                'dob'        => date('Y-m-d', strtotime($_POST['dob'])),
            ];

            $nameValidation = "/^[A-Za-z0-9_]{4,20}$/";
            $passwordValidation = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$/";

            if (!empty($_FILES['image'])) {
                $ImageInstance = new FileUploader($_FILES['image'], Users_Images_PATH);
                if ($ImageInstance->CheckFileType() && $ImageInstance->CheckFileSize()) {
                    $ImageInstance->Move_File();
                    $data['img'] = Users_Images_PATH . trim($_FILES['image']['name']);
                }else{
                    $data['img'] = '/assets/img/'.STATIC_IMAGE;
                }
            }else{
                $data['img'] = '/assets/img/'.STATIC_IMAGE;
            }

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $_SESSION['alert'] = 'please,Enter username';
                $this->Route('GoIn/signup');
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $_SESSION['alert'] = 'username must only contain characters and numbers ';
                $this->Route('GoIn/signup');
                //check if the username duplicated ?
            } elseif ($this->UPModel->IsUsernameDuplicated($data['username'])) {
                $_SESSION['alert'] = 'duplicated username ,choose another username';
                $this->Route('GoIn/signup');
            }

            //validate email
            if (empty($data['email'])) {
                $_SESSION['alert'] = 'please enter the email';
                $this->Route('GoIn/signup');
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['alert'] = 'Please include an `@` in the email address  ';
                $this->Route('GoIn/signup');
            }


            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $_SESSION['alert'] = 'please,Enter the password';
                $this->Route('GoIn/signup');
            } elseif (strlen($data['password']) < 8) {
                $_SESSION['alert'] = 'Password must contain 8 characters including at least one number';
                $this->Route('GoIn/signup');
            } elseif (!preg_match($passwordValidation, $data['password'])) {
                $_SESSION['alert'] = 'Password must contain 8 characters including at least one number';
                $this->Route('GoIn/signup');
            }elseif ($data['repassword'] !== $data['password']){
                $_SESSION['alert'] = 'Make sure the passwords match';
                $this->Route('GoIn/signup');
            }

            // Make sure that errors are empty
            if (empty($_SESSION['alert'])) {

                // Hash password
                $data['password'] = md5($data['password']);

                $regStatus = 0 ;
                if ($this->UPModel->RegisterUser($data,$regStatus)) {

                    //TO GET ALL USER INFO (STD CLASS)
                    $UserData = $this->IndexModel->GetUserInfo($data['username']);
                    // create session user
                    IndexController::createUserSession($UserData);

                    //Redirect to the home page
                    if ($this->isAdmin()) {
                        $this->Route('AdminDashboard/home');
                    } else {
                        header("Location:".URLROOT."IndexController/default");
                        exit();
                    }
                } else {
                    $this->Route('notfound/notfound');
                }
            }
        } else {
            $this->Route('GoIn/signup');
        }
    }

//    /***************************************** AJAX section *************************************/
//
//    /*
//     * Username Validation
//     *
//     * */
//    /* Function to validate username :-
//     * length
//     *
//     */
//    public function IsValidUsername($username)
//    {
//        $UsernamePattern = "/^[A-Za-z0-9_]{4,20}$/";
//        $bool = $this->UPModel->IsValidUsername($username);
//        if (strlen($username)>15 || !preg_match( $UsernamePattern, $username )){
//            $bool = false;
//        }
//        echo json_encode($bool);
//    }
//
//    /*
//     * Email Validation
//     *
//     * */
//    /* Function to validate Email :-
//     * length
//     *
//     */
//
//    public function IsValidEmail($email)
//    {
//        $bool = true ;
//        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $bool = false;
//        }
//        echo json_encode($bool);
//    }
//    /*
//     * password validation
//     *
//     */
//
//    public function IsValidPassword($password)
//    {
//        //must contain at least 8 chars , at least one lowercase char  and at least one number
//        $passwordValidation = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$/";
//        $bool = true ;
//        if (!preg_match( $passwordValidation, $password)){
//            $bool = false ;
//        }
//        echo json_encode($bool);
//    }
}