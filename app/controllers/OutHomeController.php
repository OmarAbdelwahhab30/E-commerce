<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class OutHomeController extends AbstractController
{

    private $ModelHelper;

    public function __construct()
    {
        $this->ModelHelper = $this->Model("OutHomeModel");
    }

    public function index()
    {
        $this->Route("UserStore/outhome");
    }
}