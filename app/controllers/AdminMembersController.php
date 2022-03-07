<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class AdminMembersController extends AbstractController
{


    private $ModelHelper;
    private $UPModel;


    public function __Construct()
    {
        $this->ModelHelper = $this->Model("AdminMemberModel");
        $this->UPModel = $this->Model("SignUpModel");
    }

    public function MembersView()
    {
        $this->Route("AdminDashboard/members");
    }

    public function PendingUsersView()
    {
        $data = $this->ModelHelper->GetPendingMembers();
        $this->Route("AdminDashboard/PendingMembers",$data);
    }


    public function DeleteCustomer($MemberID)
    {
        $deleted = $this->ModelHelper->DeleteMember($MemberID);
        if ($deleted){
            echo json_encode("deleted");
        }else{
            echo json_encode(0);
        }
    }

    public function EditMemberInfo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $real = json_decode($_POST['info'], true);
            $SubmittedData = [
                'username'      => trim($_POST['username']),
                'email'         => trim($_POST['email']),
                'dob'           => trim($_POST['dob']),
                'truststatus'   => trim($_POST['truststatus']),
            ];


            $RealData = [
                'userid'        => $real[0],
                'username'      => $real[1],
                'dob'           => $real[2],
                'email'         => $real[3],
                'truststatus'   => $real[4],
            ];

            $UsernamePattern = "/^[A-Za-z0-9_]{4,20}$/";
            if (empty($SubmittedData['username']) || !$this->ModelHelper->IsValidUsername($SubmittedData['username'],$RealData['userid']) || strlen($SubmittedData['username'])>15 || !preg_match( $UsernamePattern, $SubmittedData['username']))
            {
                $SubmittedData['username'] = $RealData['username'];
            }

            if (empty($SubmittedData['email']) || !filter_var($SubmittedData['email'], FILTER_VALIDATE_EMAIL)){
                $SubmittedData['email'] = $RealData['email'];
            }

            if (empty($SubmittedData['dob'])){
                $SubmittedData['dob']  = $RealData['dob'];
            }
            if ($SubmittedData['truststatus'] =! '0' || $SubmittedData['truststatus'] != '1'){
                $SubmittedData['truststatus'] = $RealData['truststatus'];
            }


            $EditDone = $this->ModelHelper->EditCustomerInfo($SubmittedData,$RealData['userid']);
            if ($EditDone){
                $_SESSION['done'] = "The member has been updated successfully";
                header("Location:".URLROOT."AdminMembersController/MembersView");
                exit();
            }
            else{
                $_SESSION['notdone'] = "something went wrong";
                header("Location:".URLROOT."AdminMembersController/MembersView");
                exit();
            }
        }

    }

    public function AddNewMember()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'repassword' => '',
            'dob' => ''
        ];

        $_SESSION['alert-modal'] = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'repassword' => trim($_POST['repassword']),
                'dob' => date('Y-m-d', strtotime($_POST['dob']))
            ];

            $nameValidation = "/^[A-Za-z0-9_]{4,20}$/";
            $passwordValidation = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$/";




            //Validate username on letters/numbers
            if (empty($data['username'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'please , Enter username';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            } elseif (!preg_match($nameValidation, $data['username'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'username must only contain characters and numbers ';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
                //check if the username duplicated ?
            } elseif ($this->UPModel->IsUsernameDuplicated($data['username'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'duplicated username ,choose another username';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            }

            //validate email
            if (empty($data['email'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'please enter the email';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'Please include an `@` in the email address  ';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            }


            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'please,Enter the password';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            } elseif (strlen($data['password']) < 8) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'Password must contain 8 characters including at least one number';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            } elseif (!preg_match($passwordValidation, $data['password'])) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'Password must contain 8 characters including at least one number';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            } elseif ($data['repassword'] !== $data['password']) {
                setcookie("1", 1, time()+3);
                $_SESSION['alert-modal'] = 'Make sure the passwords match';
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            }

            if ($this->UPModel->RegisterUser($data,1)){
               $_SESSION['alert'] = "The User has been added successfully";
                header("Location:" . URLROOT . "AdminMembersController/MembersView");
                exit();
            }


        }
    }



    /*** AJAX - JSON section  ****/

    public function ReturnUser($userid)
    {
        // all customers will show except you
        if ($userid == $_SESSION['userid']){
            echo json_encode("user not found");
        }else{
            $customer = $this->ModelHelper->ReturnCustomer($userid);
            if (!empty($customer)){
                echo json_encode($customer); //returning the array
            }else{
                echo json_encode("user not found");
            }
        }
    }

    public function ChangeRole($MemberID,$role)
    {
        $updatedRole = ($role == 'Admin')? 0:1;
        $AdminORnot = $this->ModelHelper->ChangeRole($MemberID,$updatedRole);
        if ($AdminORnot) {
            echo json_encode("ChangeRole");
        } else {
            echo json_encode(0);
        }
    }

    public function IsValidUsername($username,$userid)
    {
        $UsernamePattern = "/^[A-Za-z0-9_]{4,20}$/";
        $bool = $this->ModelHelper->IsValidUsername($username,$userid);
        if (strlen($username)>15 || !preg_match($UsernamePattern, $username)){
            $bool = false;
        }
        echo json_encode($bool);
    }

    public function ChangeBanning($MemberID,$banning_status)
    {

        $updatedRole = ($banning_status == 'blocked')? 0:1;
        $BlockedORnot = $this->ModelHelper->ChangeBanning($MemberID,$updatedRole);
        if ($BlockedORnot) {
            echo json_encode("ChangeStatus");
        } else {
            echo json_encode(0);
        }
    }

    public function ActivateUser($userid)
    {
        if ($this->ModelHelper->ActivateUser($userid)){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
}