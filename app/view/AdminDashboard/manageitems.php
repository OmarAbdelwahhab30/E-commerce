<?php
$title = "Items";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>

    <script>
        let itemID;
        function DeleteItem(){
            $.ajax({
                url:`<?=URLROOT?>AdminItemsController/DeleteItem/${itemID}`,
                dataType:'json',
                cache:false,
                success:function (data,status) {
                    var content;
                    if (JSON.parse(data)==false){
                        content = "<div class='alert alert-danger' role='alert'>"+"Something went wrong"+"</div>"
                    }else {
                        content = "<div class='alert alert-success' role='alert'>"+"Item has been deleted successfully"+"</div>"
                    }
                    $("#deleteresult").html(content);
                }
            })
        }

        let approveID;
        function ApproveItem(){
            $.ajax({
                url:`<?=URLROOT?>AdminItemsController/ApproveItem/${approveID}`,
                dataType:'json',
                cache:false,
                success:function (data,status) {
                    var content;
                    if (JSON.parse(data)==false){
                        content = "<div class='alert alert-danger' role='alert'>"+"Something went wrong"+"</div>"
                    }else {
                        content = "<div class='alert alert-success' role='alert'>"+"Item has been Approved successfully"+"</div>"
                    }
                    $("#deleteresult").html(content);
                }
            })
        }
    </script>
    <div class="container ">
        <div class="modal-header">
            <a href="<?=URLROOT?>AdminItemsController/AddNewItem" class="btn btn-outline-dark" id="exampleModalLabel">Add new Product  </a>
        </div>
        <!-- Items Tables -->
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products Table</h6>
            </div>
            <div id="deleteresult">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product-Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Username</th>
                            <th style="width: 10%">Actions</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($data)){
                            foreach ($data as $item){
                                ?>
                                <tr>
                                    <td><?=$item->name?></td>
                                    <td class="w-25"><?=$item->description?></td>
                                    <td><?=$item->price?>$</td>
                                    <td><img style="height: 100px; width: 100px;border-radius: 10px" src="<?=URLROOT.$item->img?> "></td>
                                    <td><?=$item->categname?></td>
                                    <td><?=$item->username?></td>
                                    <td>
                                            <a class="text-decoration-none" href="<?=URLROOT?>AdminItemsController/UpdateItemView/<?=$item->itemid?>">
                                                <i class="fa fa-edit text-success" aria-hidden="true"></i>
                                            </a>
                                            <a class="text-decoration-none " href="#" onclick="itemID=<?=$item->itemid?>" data-bs-toggle="modal" data-bs-target="#DeleteItemModal">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                            <?php
                                            if ($item->approve == 0){
                                            ?>
                                            <a class="text-decoration-none" onclick="approveID=<?=$item->itemid?>" data-bs-toggle="modal" data-bs-target="#approvemodal" href="#">
                                                <i class="fa fa-check text-info" aria-hidden="true">
                                                </i>
                                            </a>

                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?=URLROOT?>AdminCommentsController/Comments/1/<?=$item->itemid?>" class=" w-100 btn btn-outline-dark "  >
                                            <span class="btn-block">Show Comments</span>
                                        </a>
                                    </td>

                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="7">No Products to show</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>

                    </table>

                    <!---- Start Pagination ---->
                    <div class="mx-5">
                        <nav   aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php

                                if (!empty($data2)) {
                                    if ($data2['PagesNum'] > 1){
                                        for($page = 1; $page<=$data2['PagesNum']; $page++) {?>
                                            <li class="page-item"><a class="page-link" href="<?=URLROOT?>AdminItemsController/ManageItems/<?=$page?>"><?=$page?></a></li>
                                        <?php }
                                    }
                                }
                                ?>

                            </ul>
                        </nav>
                    </div>
                    <!---- End Pagination ---->



                </div>
            </div>
        </div>

    </div>

    <!--Delete Item  Modal -->
    <div class="modal fade" id="DeleteItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete An Item !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure To delete this Item ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="DeleteItem()" data-bs-dismiss="modal" >Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!--Approval Item  Modal -->
    <div class="modal fade" id="approvemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Item Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure To Approve  this Item ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-info" onclick="ApproveItem()" data-bs-dismiss="modal" >Approve</button>
                </div>
            </div>
        </div>
    </div>
<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




