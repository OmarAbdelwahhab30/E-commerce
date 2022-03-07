<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\FileUploader;
use PHPMVC\lib\Paginator;

class UserItemsController extends  AbstractController
{

    /**
     * @var mixed
     */
    private $ModelHelper;
    const TABLE_NAME = "comments" ;
    private  $PaginatorInstance  ;
    private $PagesNum;

    public array $JoinInfo = [
        "Join"      => true,
        "TablesNum" => 2,
        "table1"    => self::TABLE_NAME,
        "table2"    => "users",
        "table3"    => "",
        "cond1"     => "comments.userid = users.userid",
        "cond2"     => "",
        "ColsName"  => "comments.comment,comments.date,users.username,users.roles,users.img,comments.userid,comments.commentid",
        "where"     => "",
    ];

    public function __construct()
    {
        $this->ModelHelper = $this->Model("UserItemsModel");
        $this->ModelAdminHelper = $this->Model("AdminItemsModel");
        $this->ModelCategoryHelper = $this->Model("AdminCategoryModel");
    }

    public function PaginationHandler($page)
    {
        $this->PaginatorInstance = new Paginator(self::TABLE_NAME,"commentid",1,$page,$this->JoinInfo);
        $this->PagesNum = $this->PaginatorInstance->GetPagesNum();
    }


    public function ItemsCategoryView($categoryID,$categoryname)
    {
        $category = $this->ModelHelper->GetItemsCategory($categoryID);
        $this->Route("UserStore/category",$category,$categoryname);
    }

    public function Item($ItemID,$page)
    {
        $Item = $this->ModelHelper->GetItem($ItemID);
        $this->JoinInfo['where'] = "comments.itemid=".$ItemID;
        $this->PaginationHandler($page);
        $AllComments = $this->PaginatorInstance->Paginate();
        $Pagination['PagesNum'] = $this->PagesNum;
        $data2 = [
            "AllComments"     => $AllComments,
        ];
        $this->Route("UserStore/item",$Item,$data2,$Pagination);
    }

    public function AddProduct()
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
                'userid' => $_SESSION['userid'],
            ];
            $ImageInstance = new FileUploader($_FILES['image'],ITEMS_IMAGES_PATH);
            if ($ImageInstance->CheckFileType() && $ImageInstance->CheckFileSize()){
                $data['img'] =    ITEMS_IMAGES_PATH.trim($_FILES['image']['name']);
            }

            if ($this->ModelAdminHelper->RegisterItem($data)){
                $ImageInstance->Move_File();
                $_SESSION['alert-suc'] ="Item Has been added successfully";
                header("Location:".URLROOT."UserItemsController/AddProduct");
                exit();
            }else{
                $_SESSION['alert'] ="SomeThing Went Wrong , please try again";
                header("Location:".URLROOT."UserItemsController/AddProduct");
                exit();
            }
        } else {
            $this->Route("UserStore/additem", $AllCategories);
        }
    }
}