<?php
$title = "Category";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";
?>
    <script>
        function AddToCart(value) {
            ID = value;
            $.ajax({
                url: `<?=URLROOT?>UserPaymentController/AddToCart/${value}`,
                dataType: "json",
                cache: false,
                success: function (data, status) {
                    let content = "";
                }
            })
        }

    </script>

        <div class="d-flex justify-content-center mt-3"> <span class="text text-center">Finding Best Products Now<br> in Your Fingertips</span> </div>
    <div class="container">
        <h3 class="h3"><?=$data2?></h3>
        <div class="row">
<?php
?>
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
                        <div class="clearfix mb-3"> <span class="float-start badge rounded-pill bg-primary"><?=$data2?></span>
                            <span class="float-end price-hp"><?=$item->price?>$</span>
                        </div>
                        <button type="button" onclick='AddToCart(<?=$item->itemid?>)' class="carts btn btn-warning"
                                 style="font-size: 14px;text-transform: none" >
                            Add To Cart
                        </button>

                        <a href="<?=URLROOT?>UserItemsController/Item/<?=$item->itemid?>/1"  class="btn btn-dark  mt-2">
                                <span >Info</span>
                        </a>
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
<?php
require_once INCLUDES_USER_PATH."/footer.php";


