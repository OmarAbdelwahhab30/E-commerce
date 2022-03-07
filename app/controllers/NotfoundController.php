<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class NotfoundController extends AbstractController
{

    public function index($bool = array())
    {
        $this->Route("notfound/notfound");
    }
}