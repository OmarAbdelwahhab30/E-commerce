<?php
?>

<style>
    .fas {
        color: white;
        font-size: 100px;
        margin-top: 60px;
    }
    .fas:hover {
        color: #e7ae1e;
    }
    a.cart{
        text-decoration: none;
    }
    ul li a.cart:hover {
        text-decoration: none;
        color: #e7ae1e;
    }

    ul li a.cart .cart-basket {
        position: absolute;
        top: -6px;
        right: -5px;
        width: 45px;
        height: 45px;
        color: #fff;
        background-color: #418deb;
        border-radius: 50%;
        margin-top: 60px;
        font-size: 30px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div style="margin-left: -175px;" class="col-3 px-1 sm-dark position-fixed" >
            <div class="sticky-top">
                        <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark" style="width: 250px;">
                            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <svg class="bi me-2" width="30px" height="32"> </svg>
                                <span class="fs-4"><img width="100px" height="100px" src="<?=URLROOT?>/assets/img/cart2.png"></span>
                            </a>
                            <hr>
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a href="<?=URLROOT?>UserHomeController/index" class="nav-link active" aria-current="page">
                                        <i class="fa fa-home"></i><span class="ms-2">Home</span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION['roles'] == "1"){
                                ?>
                                <li>
                                    <a href="<?=URLROOT?>AdminHomeController/HomeView" class="nav-link text-white"> <i class="fa fa-dashboard"></i>
                                        <span class="ms-2">Admin Dashboard</span>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <a  data-bs-toggle="collapse" href="#collapseExample" class="nav-link text-white"> <i class="fa fa-first-order"></i>
                                        <span class="ms-2 dropdown-toggle">Categories </span>
                                    </a>
                                    <ul id="collapseExample" style="margin-left: 50px" class="list-unstyled collapse ">
                                        <?php
                                        if (!empty($_SESSION['categories'])){
                                         foreach ($_SESSION['categories'] as $categ){
                                          ?>
                                        <li class="">
                                            <a href="<?=URLROOT?>UserItemsController/ItemsCategoryView/<?=$categ->categid?>/<?=$categ->categname?>" class="text-decoration-none text-muted">
                                                <?=$categ->categname?>
                                            </a>
                                        </li>
                                        <hr class="w-50">
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?=URLROOT?>UserProfileController/Profile/<?=$_SESSION['userid']?>" class="nav-link text-white"> <i class="fa fa-address-card"></i>
                                        <span class="ms-2">Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=URLROOT?>UserEditProfileController/EditProfileView" class="nav-link text-white"> <i class="fa fa-edit"></i>
                                        <span class="ms-2">Profile Setting</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=URLROOT?>UserItemsController/AddProduct" class="nav-link text-white"> <i class="fa fa-product-hunt"></i>
                                        <span class="ms-2">Add Product</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=URLROOT?>IndexController/logout" onclick="DeleteSessionCart();" class="nav-link text-white"> <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        <span class="ms-2">Sign out</span>
                                    </a>
                                </li>

                                <li class="cartt nav-item px-3 text-uppercase mb-0 position-relative d-lg-flex">
                                    <div id="cart" class="d-none">

                                    </div>
                                    <a  href="<?=URLROOT?>UserPaymentController/index" class="cart position-relative d-inline-flex" aria-label="View your shopping cart">
                                        <i class="fas fa fa-shopping-cart fa-lg" style="font-size: 100px"></i>
                                    </a>
                                </li>

                                <li>
                                    <button  style="text-transform: none;" onclick="EmptyTheBasket();DeleteSessionCart()"  class="btn btn-outline-warning mt-5">Empty The Basket</button>
                                </li>
                                <script>
                                    function DeleteSessionCart() {
                                        $.ajax({
                                            url: `<?=URLROOT?>UserPaymentController/DeleteSessionCart`,
                                            cache: false,
                                            success: function (data, status) {
                                                let content = "";
                                            }
                                        })
                                        localStorage.setItem("cartnum",0);
                                    }
                                </script>
                            </ul>

                            <script>


                            </script>
                            <hr>
                            <div> <a href="#" class="d-flex align-items-center text-white text-decoration-none"
                                                      aria-expanded="false">
                                    <img src="<?=URLROOT.$_SESSION['img']?>" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong> <?=$_SESSION['username']?> </strong> </a>
                            </div>
                        </div>
            </div>

        </div>

        <div class="col offset-3" id="main">
