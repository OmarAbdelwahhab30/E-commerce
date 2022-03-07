<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class UserProfileController extends AbstractController
{

    public function __Construct()
    {
        $this->ModelHepler = $this->Model("UserProfileModel");
    }

    public function Profile($userid)
    {
        $Products = $this->ModelHepler->GetUserProducts($userid);
        $this->Route("UserStore/profile",$Products);
    }

}