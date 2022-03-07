<?php
$title = "Payment";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";
$Total =0 ;
?>


    <div class="container ">
        <!-- Category Tables -->
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Purchase List</h6>
            </div>
            <div id="deleteresult">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>##</th>
                            <th>name</th>
                            <th>price</th>
                            <th>img</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($_SESSION['Cart'])){
                            foreach ($_SESSION['Cart'] as $item){
                                ?>
                        <tr  id="ItemDataResult">
                            <td><button class="btn btn-danger" href="#" onclick='DeleteItemFromSession(<?=$item['cartcount']?>);DeleteItem();'>
                                    <i class="fa fa-times text-white" aria-hidden="true">
                                        Remove
                                    </i>
                                </button>
                            </td>
                            <td><?=$item['name']?>$</td>
                            <td><?=$item['price']?>$</td>
                            <?php
                            $Total+=$item['price'];
                            ?>
                            <td><img style="height: 100px; width: 100px;border-radius: 10px" src="<?=URLROOT.$item['img']?>" alt="item"></td>
                        </tr>
                            <?php
                             }
                                }else{
                            ?>
                            <tr><td colspan="4">There is no Products in Basket</td></tr>
                        <?php
                        }
                                ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$Total?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-info text-capitalize">Purchase</button>
                </div>
            </div>
        </div>

    </div>
<script>
    function DeleteItem() {
        $('#ItemDataResult').remove();
    }
    function DeleteItemFromSession(itemid) {
        $.ajax({
            url: `<?=URLROOT?>UserPaymentController/DeleteItemFromSession/${itemid}`,
            cache: false,
            success: function (data, status) {
                let content = "";
            }
        })
    }
</script>

<?php
require_once INCLUDES_USER_PATH."/footer.php";




