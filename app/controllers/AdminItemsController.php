<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\FileUploader;
use PHPMVC\lib\Paginator;

class AdminItemsController extends AbstractController
{

    /**
     * @var mixed
     */
    private $ModelHelper;
     const TABLE_NAME = "items" ;
    private  $PaginatorInstance  ;
    private $PagesNum;

    public array $JoinInfo = [
            "Join"      => true,
            "TablesNum" => 3,
            "table1"    => self::TABLE_NAME,
            "table2"    => "categ",
            "table3"    => "users",
            "cond1"     => "items.categid = categ.categid",
            "cond2"     => "items.userid = users.userid",
            "ColsName"  => " items.itemid,items.name,items.description,items.price,items.add_date,items.img,items.approve,categ.categname,users.username",
            "where"     => 1,
    ];

    public function __construct()
    {
        $this->ModelHelper = $this->Model("AdminItemsModel");
        $this->JoinHelper = $this->Model("IndexModel");
        $this->ModelCategoryHelper = $this->Model("AdminCategoryModel");
    }

    public function PaginationHandler($page)
    {
        $this->PaginatorInstance = new Paginator(self::TABLE_NAME,"itemid",1,$page,$this->JoinInfo);
        $this->PagesNum = $this->PaginatorInstance->GetPagesNum();
    }

    public function ManageItems($page)
    {
        $this->PaginationHandler($page);
        $AllItems = $this->PaginatorInstance->Paginate();
        $Pagination['PagesNum'] = $this->PagesNum;
        $this->Route("AdminDashboard/manageitems",$AllItems,$Pagination);
    }

    public function AddNewItem()
    {
        $AllCategories = $this->ModelCategoryHelper->GetAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'itemname' => trim($_POST['itemname']),
                'itemdesc' => trim($_POST['itemdesc']),
                'price' => trim($_POST['price']),
                'country' => trim($_POST['country']),
                'status' => trim($_POST['status']),
                'category' => trim($_POST['category']),
                'userid' => trim($_POST['userid']),
            ];
            $ImageInstance = new FileUploader($_FILES['image'],ITEMS_IMAGES_PATH);
            if ($ImageInstance->CheckFileType() && $ImageInstance->CheckFileSize()){
                $data['img'] =    ITEMS_IMAGES_PATH.trim($_FILES['image']['name']);
            }

            if ($this->ModelHelper->RegisterItem($data)){
                $ImageInstance->Move_File();
                $_SESSION['alert-suc'] ="Item Has been added successfully";
                header("Location:".URLROOT."AdminItemsController/AddNewItem");
                exit();
            }else{
                $_SESSION['alert'] ="SomeThing Went Wrong , please try again";
                header("Location:".URLROOT."AdminItemsController/AddNewItem");
                exit();
            }
        } else {
            $this->Route("AdminDashboard/additem", $AllCategories);
        }
    }


    public function UpdateItemView($ItemID)
    {
        $item = $this->ModelHelper->GetItem($ItemID);
        $AllCategories = $this->ModelCategoryHelper->GetAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            var_dump($_POST);
            var_dump($item);
            $data = [
                "itemname"  => !empty($_POST['itemname'])? trim($_POST['itemname']):$item->name,
                'itemdesc'  => !empty($_POST['itemdesc'])? trim($_POST['itemdesc']):$item->description,
                'price'     => !empty($_POST['price'])? trim($_POST['price']):$item->price,
                'country'   => !empty($_POST['country'])? trim($_POST['country']):$item->country_made,
                'status'    => !empty($_POST['status'])? trim($_POST['status']):$item->status,
                'category'  => !empty($_POST['category'])? trim($_POST['category']):$item->categid,
                'userid'    => !empty($_POST['userid'])? trim($_POST['userid']):$item->userid,
                'img' => $item->img,

            ];
            if (isset($_FILES['image'])) {
                $ImageInstance = new FileUploader($_FILES['image'], ITEMS_IMAGES_PATH);
                if ($ImageInstance->CheckFileType() && $ImageInstance->CheckFileSize()) {
                    $ImageInstance->DeleteFile($item->img);
                    $data['img'] = ITEMS_IMAGES_PATH . trim($_FILES['image']['name']);
                }
            }else{
                $data['img'] = $item->img;
            }

            if ($this->ModelHelper->UpdateItem($data,$ItemID)){
                if (isset($_FILES['image'])) {
                    $ImageInstance->Move_File();
                }
                $_SESSION['alert-suc'] = "Item has been Updated successfully";
                header("location:" . URLROOT . "AdminItemsController/UpdateItemView/$ItemID");
                exit();
            }
        } else {
            $this->Route("AdminDashboard/edititem",$item,$AllCategories);
        }
    }


    /****** AJAX Section *********/

    public function GetUserData($username)
    {
        $UserData = $this->ModelHelper->GetUserData($username);
        if ($UserData){
            echo json_encode($UserData);
        }else{
            echo json_encode("There is no such User");
        }
    }

    public function DeleteItem($ItemID)
    {
        $bool = $this->ModelHelper->DeleteItem($ItemID);
        echo json_encode($bool);
    }

    public function ApproveItem($ItemID)
    {
        $bool = $this->ModelHelper->ApproveItem($ItemID);
        echo json_encode($bool);
    }

}