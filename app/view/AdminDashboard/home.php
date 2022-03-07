<?php
$title = "Admin Dashboard";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>
<div class="mt-lg-5">

    <div class="container ">
        <h1 class="text-center mb-5">Dashboard</h1>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a style="text-decoration: none;color:royalblue" href="<?=URLROOT?>AdminMembersController/MembersView">Total Users</a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$data['totalUsers']?></div>
                            </div>
                            <div class="col-auto">
                                <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div  class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <a style="text-decoration: none;color: #2c786c" href="<?=URLROOT?>AdminMembersController/PendingUsersView">Pending Users</a>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$data['totalPendingRequests']?></div>
                            </div>
                            <div class="col-auto">
                                <h1><i class="fa fa-clock-o" aria-hidden="true"></i></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Items
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$data['no_total_Items']?></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <h1><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Comments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$data['no_total_comments']?></div>
                            </div>
                            <div class="col-auto">
                                <h1><i class="fa fa-comments" aria-hidden="true"></i></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">


            <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Latest Registered Users</h6>

                    </div>

                    <div class="card-body">
                        <div class="chart-area">
                            <div class="">
                                <?php
                                if (!empty($data['latest_Registered_users'])){
                                foreach ($data['latest_Registered_users'] as $user){
                                ?>
                                <img src="<?=URLROOT.$user->img?>"  height='40px' style='border-radius: 50%'  alt='avatar'>
                                <span><?=$user->username?></span>
                                <hr>
    <?php
                                    }
                                }
    ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">

                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Latest Items</h6>
                    </div>

                    <div class="card-body">
                        <div class="chart-area">
                            <div class="">
                                <?php
                                if (!empty($data['latest_items'])){
                                    foreach ($data['latest_items'] as $item){
                                        ?>
                                        <span><?=$item->name?></span>
                                        <hr>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>


    </div>
</div>

<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




