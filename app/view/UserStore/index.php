<?php
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
?>




    <div class="mt-lg-5">

        <div class="container ">
            <h1 class="text-center mb-5 text-success">e-store</h1>
            <div style="margin-left: 10px" class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <a style="text-decoration: none;color:royalblue" >Total Users</a>
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
            <section class="container py-5">
                <div class="row text-center pt-3">
                    <div class="col-lg-6 m-auto">
                        <h1 class="h1">Find What you need Here </h1>
                        <p>
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 p-5 mt-3">
                        <a href="#"><img style="border-radius: 10%" src="<?=URLROOT?>/assets/img/ItemsImages/61dHtJrlcOL._AC_SL1500_.jpg" class="rounded-circle img-fluid border"></a>
                        <h5 class="text-center mt-3 mb-3">Watches</h5>
                    </div>
                    <div class="col-12 col-md-4 p-5 mt-3">
                        <a href="#"><img style="border-radius: 10%" src="<?=URLROOT?>/assets/img/ItemsImages/SL20_Shoes_Yellow_FW9297_01_standard.jpg" class="rounded-circle img-fluid border"></a>
                        <h2 class="h5 text-center mt-3 mb-3">Shoes</h2>
                    </div>
                    <div class="col-12 col-md-4 p-5 mt-3">
                        <a href="#"><img style="border-radius: 10%" src="<?=URLROOT?>/assets/img/ItemsImages/71MxKc7ZW-L._AC_SL1500_.jpg" class="rounded-circle img-fluid border"></a>
                        <h2 class="h5 text-center mt-3 mb-3">Accessories</h2>
                    </div>
                </div>
            </section>
            <!-- End Categories of The Month -->

        </div>
    </div>




<?php
require_once INCLUDES_USER_PATH."/footer.php";
