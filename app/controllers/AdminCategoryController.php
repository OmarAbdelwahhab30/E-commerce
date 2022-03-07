<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\Paginator;

class AdminCategoryController extends AbstractController
{
    private $ModelHelper;

    private  $PaginatorInstance  ;

    const TABLE_NAME = "categ" ;

    private $PagesNum;


    public array $JoinInfo = [
        "Join"      => false,
        "TablesNum" => 0,
        "table1"    => self::TABLE_NAME,
        "table2"    => "",
        "table3"    => "",
        "cond1"     => "",
        "cond2"     => "",
        "ColsName"  => " categid,categname,description,visibility,allowcomment,allowAds",
        "where"     => 1,
    ];

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("AdminCategoryModel");
    }

    public function PaginationHandler($page)
    {
        $this->PaginatorInstance = new Paginator(self::TABLE_NAME,"categid",1,$page,$this->JoinInfo);
        $this->PagesNum = $this->PaginatorInstance->GetPagesNum();
    }

    public function ManageCategoryView($page)
    {
        $this->PaginationHandler($page);
        $AllCategories = $this->PaginatorInstance->Paginate();
        $Pagination['PagesNum'] = $this->PagesNum;
        $this->Route("AdminDashboard/managecategories",$AllCategories,$Pagination);
    }

    public function AddCategoryView()
    {
        $this->Route("AdminDashboard/addcategory");
    }

    public function UpdateCategoryView($categoryID)
    {
        $category = $this->ModelHelper->GetCategory($categoryID);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'categname' => isset($_POST['categname'])? trim($_POST['categname']):$category->categname,
                'categdesc' => isset($_POST['categdesc'])? trim($_POST['categdesc']):$category->description,
                'visibility' => isset($_POST['visibility'])? trim($_POST['visibility']):$category->visibility,
                'comments' => isset($_POST['comments'])? trim($_POST['comments']):$category->allowcomment,
                'ads' => isset($_POST['ads'])? trim($_POST['ads']):$category->allowAds,
            ];

            if ($this->ModelHelper->UpdateCategory($data,$categoryID)) {
                $_SESSION['alert-suc'] = "Category has been Updated successfully";
                header("location:" . URLROOT . "AdminCategoryController/UpdateCategoryView/$categoryID");
                exit();
            }
        } else {
            $this->Route("AdminDashboard/editcategory",$category);
        }
    }

    public function AddNewCategory()
    {
        $data = [
            'name' => '',
            'desc' => '',
            'vis' => '',
            'comments' => '',
            'ads' => ''
        ];

        $_SESSION['alert'] = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'categname' => trim($_POST['categname']),
                'categdesc' => trim($_POST['categdesc']),
                'visibility' => trim($_POST['visibility']),
                'comments' => trim($_POST['comments']),
                'ads'   => trim($_POST['ads']),
            ];


            // Validation
            if (empty($data['categname'])){
                $_SESSION['alert'] = "Please Enter the category name";
                header("location:".URLROOT."AdminCategoryController/AddCategoryView");
                exit();
            }

            if ($this->ModelHelper->RegisterCategory($data)){
                $_SESSION['alert-suc'] = "Category has been added successfully";
                header("location:".URLROOT."AdminCategoryController/AddCategoryView");
                exit();
            }
        }
    }



    /*Ajax section*/

    public function DeleteCategory($categoryID)
    {
        $bool = $this->ModelHelper->DeleteCategory($categoryID);
        echo json_encode($bool);
    }
}