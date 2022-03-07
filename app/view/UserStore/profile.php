<?php
$title = "Profile";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";
$EditProfileHref = ($_SESSION['roles']=='1')? "AdminEditProfileController/EditProfileView":"UserEditProfileController/EditProfileView";
?>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?=URLROOT.$_SESSION['img']?>" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?=$_SESSION['username']?></h4>
                                    <p class="text-secondary mb-1"><?=($_SESSION['roles']!="1")?"Customer":"Admin"?></p>
                                    <p class="text-muted font-size-sm"><?=$_SESSION['email']?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">User Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$_SESSION['username']?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$_SESSION['email']?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date-Of-Birth</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$_SESSION['dob']?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Trust-Status</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=($_SESSION['truststatus']=="1")?"Activated":"Not Provided"?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-dark "
                                       href="<?=URLROOT.$EditProfileHref?>">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h1 class="text-center text-muted">My-Products</h1>






            <main>
                <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        <?php
                        if (!empty($data)){
                            foreach ($data as $item){
                                ?>
                                <div class="col">
                                    <div class="card h-100 shadow-sm"> <img style="" src="<?=URLROOT.$item->img?>" class="card-img-top" alt="...">
                                        <span class="text-center text-success"><?=$item->name?></span>
                                        <div class="card-body">
                                            <div class="clearfix mb-3"> <span class="float-start badge rounded-pill bg-primary"></span>
                                                <span class="float-end price-hp"><?=$item->price?>$</span>
                                            </div>
                                            <h5 class="card-title"><?=$item->description?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="alert alert-info w-100 text-center" role="alert">
                                <span class="text-center">There is no items to show</span>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </main>

















        </div>
    </div>

<?php
require_once INCLUDES_USER_PATH."/footer.php";
