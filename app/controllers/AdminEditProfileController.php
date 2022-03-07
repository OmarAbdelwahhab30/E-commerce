<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\FileUploader;

class AdminEditProfileController extends AbstractController
{

    private $ModelHelper;
    private $InModel;

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("AdminEditProfileModel");
        $this->InModel = $this->Model("SignInModel");
    }

    public function EditProfileView()
    {
        $this->Route('AdminDashBoard/EditProfile');
    }

    public function UpdateProfileInfo($UserID)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'dob' => date('Y-m-d', strtotime($_POST['dob'])),
                'email'         => trim($_POST['email']),
                'oldpassword'   => trim($_POST['oldpass']),
                'newpassword'   => trim($_POST['newpass']),
                'confirmpass'   => trim($_POST['confirmnewpass']),

            ];

            $UpdatedData = [
                'username'      => '',
                'email'         => '',
                'newpassword'   => '',
                'dob'           => '',
            ];


            // username validation
            $UsernamePattern = "/^[A-Za-z0-9_]{4,20}$/";
            if (empty($data['username'])) {
                $UpdatedData['username'] = $_SESSION['username'];
            }
            elseif ($data['username'] === $_SESSION['username']){
                $UpdatedData['username'] = $_SESSION['username'];
            } elseif (!preg_match($UsernamePattern, $data['username'])) {
                $_SESSION['alert'] = 'username must only contain characters and numbers ';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }elseif ($this->ModelHelper->IsUsernameDuplicated($data['username'],$_SESSION['userid'])) {
                $_SESSION['alert'] = 'duplicated username ,choose another username';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }else{
                $UpdatedData['username'] = $data['username'];
            }

            //email validation
            if (empty($data['email'])) {
                $UpdatedData['email'] = $_SESSION['email'];
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['alert'] = 'Please include an `@` in the email address  ';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }else{
                $UpdatedData['email'] = $data['email'];
            }


            //password validation
            $oldPassword  = $this->ModelHelper->IsOldPasswordTrue($_SESSION['userid']) ;
        if (empty($data['oldpassword'])){
            $UpdatedData['newpassword'] = $oldPassword;

        } elseif (md5($data['oldpassword']) != $oldPassword){
            $_SESSION['alert'] = 'old password is not true ,please try again !';
            header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
            exit();
            }

        if (empty($data['oldpassword']) && !empty($data['newpassword']) ||  empty($data['oldpassword']) && !empty($data['confirmpass'])){
            $_SESSION['alert'] = 'please,Enter your old  password correctly';
            header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
            exit();
        }
            $passwordValidation = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$/";
            if ( empty($data['newpassword']) && empty($data['confirmpass']) && empty($data['oldpassword'])){
                $UpdatedData['newpassword'] = $oldPassword;
            }
            elseif (  (empty($data['newpassword']) && !empty($data['confirmpass'])) || (!empty($data['newpassword']) && empty($data['confirmpass']))) {
                $_SESSION['alert'] = 'please,Enter the new  password correctly';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }  elseif (!preg_match($passwordValidation, $data['newpassword'])) {
                $_SESSION['alert'] = 'Password must contain 8 characters including at least one number';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }elseif ($data['confirmpass'] !== $data['newpassword']){
                $_SESSION['alert'] = 'Make sure the passwords match';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }else{
                $UpdatedData['newpassword'] = md5($data['newpassword']);
            }



            // date of birth validation
            if (empty($data['dob'])){
                $UpdatedData['dob'] =  $_SESSION['dob'];
            }else{
                $UpdatedData['dob'] = $data['dob'] ;
            }

            if (!empty($_FILES['image'])) {
                $ImageInstance = new FileUploader($_FILES['image'], Users_Images_PATH);
                if ($ImageInstance->CheckFileType() && $ImageInstance->CheckFileSize()) {
                    $UpdatedData['img'] = Users_Images_PATH . trim($_FILES['image']['name']);
                    if ($_SESSION['img'] != DS.'assets'.DS.'img'.DS.STATIC_IMAGE) {
                        $ImageInstance->DeleteFile($_SESSION['img']);
                    }
                    $ImageInstance->Move_File();
                }else{
                    $UpdatedData['img'] = $_SESSION['img'];
                }
            }else{
                $UpdatedData['img'] = $_SESSION['img'];
            }

            if ($this->ModelHelper->UpdatedData($UpdatedData)){
                $UserNewData = $this->InModel->CheckUserAndReturn($UpdatedData['username'], $UpdatedData['newpassword']);
                if ($UserNewData) {
                    IndexController::createUserSession($UserNewData);
                }
                $_SESSION['alert-suc'] = 'Your Data has been Updated Successfully ';
                header("Location:".URLROOT."AdminEditProfileController/EditProfileView");
                exit();
            }



        }
    }

    public function DeleteProfilePic()
    {
        unlink($_SESSION['img']);
        $_SESSION['img'] = DS.'assets'.DS.'img'.DS.STATIC_IMAGE;
        if ($this->ModelHelper->DeleteImage()) {
            header("Location:" . URLROOT . "AdminEditProfileController/EditProfileView");
            exit();
        }
    }

}