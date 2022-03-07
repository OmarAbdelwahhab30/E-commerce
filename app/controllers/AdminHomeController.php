<?php

namespace PHPMVC\controllers;

use PHPMVC\lib\AbstractController;

class AdminHomeController extends AbstractController
{

    private $ModelHelper;

    public function __construct()
    {
        $this->ModelHelper = $this->Model("IndexModel");
    }

    public function HomeView()
    {
        $no_total_users            = $this->ModelHelper->CountTableRows("users","userid","roles !=1");
        $no_total_pending_requests = $this->ModelHelper->CountTableRows("users","userid","regstatus = 0 AND roles !=1");
        $no_total_Items = $this->ModelHelper->CountTableRows("items","itemid",1);
        $no_total_Comments = $this->ModelHelper->CountTableRows("comments","commentid",1);

        $latest_Registered_users   = $this->ModelHelper->GetLatest("users","username,img"," roles != 1 "," userid DESC",4 );
        $latest_Items              = $this->ModelHelper->GetLatest("items","name","1"," itemid DESC",4 );
        $data = [
            'totalUsers'                => $no_total_users->count,
            'totalPendingRequests'      => $no_total_pending_requests->count,
            'latest_items'              => $latest_Items,
            'latest_Registered_users'   =>$latest_Registered_users,
            'no_total_Items'            =>$no_total_Items->count,
            'no_total_comments'         =>$no_total_Comments->count,
        ];
        $this->Route('AdminDashBoard/home',$data);
    }
}