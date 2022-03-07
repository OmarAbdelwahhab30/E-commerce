<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;
use PHPMVC\lib\Paginator;

class AdminCommentsController extends AbstractController
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
        "TablesNum" => 3,
        "table1"    => self::TABLE_NAME,
        "table2"    => "items",
        "table3"    => "users",
        "cond1"     => "comments.itemid = items.itemid",
        "cond2"     => "comments.userid = users.userid",
        "ColsName"  => " users.username, users.blocked,comments.comment,users.img,comments.date,comments.itemid,users.roles,comments.commentid,users.blocked,users.userid",
        "where"     => "",
    ];

    public function __Construct()
    {
        $this->ModelHelper = $this->Model("AdminCommentsModel");
        $this->ItemHelper = $this->Model("AdminItemsModel");
    }

    public function PaginationHandler($page)
    {
        $this->PaginatorInstance = new Paginator(self::TABLE_NAME,"commentid",1,$page,$this->JoinInfo);
        $this->PagesNum = $this->PaginatorInstance->GetPagesNum();
    }


    public function Comments($page,$itemid)
    {
        $this->itemid  =  $itemid ;
        $item = $this->ItemHelper->GetItem($itemid);
        $this->JoinInfo['where'] = "items.itemid = ".$itemid;
        $this->PaginationHandler($page);
        $AllComments = $this->PaginatorInstance->Paginate();
        $Pagination['PagesNum'] = $this->PagesNum;
        $data = [
            'item'      => $item,
            'comments'  => $AllComments,
        ];
        $this->Route("AdminDashboard/comments",$data,$Pagination);
    }

    public function RemoveComment($commentID,$itemid)
    {
        if ($this->ModelHelper->RemoveComment($commentID))
        {
            header("Location:".URLROOT."AdminCommentsController/Comments/1/".$itemid);
            exit();
        }
    }

    public function EditComment()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($this->ModelHelper->EditComment($_POST['Updatedcomment'],$_POST['commentid'])){
            header("Location:".URLROOT."AdminCommentsController/Comments/1/".$_POST['itemid']);
            exit();
        }
    }

    public function AddComment($itemid,$userid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $comment = trim($_POST['comment']);
        if ($this->ModelHelper->AddComment($userid,$itemid,$comment)){
                header("Location:".URLROOT."AdminCommentsController/Comments/1/".$itemid);
                exit();
            }
        }
    }
}