<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class OutHomeModel
{

    private $db ;
    public function __Construct()
    {
        $this->db = new Database();
    }

}