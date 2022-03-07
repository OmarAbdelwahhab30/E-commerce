<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class UserPaymentController extends AbstractController
{

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("UserPaymentModel");
        $this->ItemModelHelper = $this->Model("UserItemsModel");
    }

    public function index()
    {
        $this->Route("UserStore/payment");
    }

    /*AJAX Section*/

    public function AddToCart($itemid)
    {
        $ArrayLength = count($_SESSION['Cart']);
        $item = $this->ItemModelHelper->GetItem($itemid);
        $item->cartcount = $ArrayLength;
        $_SESSION['Cart'][] = get_object_vars($item);
    }

    public function DeleteSessionCart()
    {
        unset($_SESSION['Cart']);
    }

    public function DeleteItemFromSession($cartCount)
    {
        unset($_SESSION['Cart'][$cartCount]);
    }
}