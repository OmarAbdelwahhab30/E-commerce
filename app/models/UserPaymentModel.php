<?php

namespace PHPMVC\models;

use PHPMVC\lib\Database;

class UserPaymentModel
{

    public function __Construct()
    {
        $this->db = new Database();
    }

}