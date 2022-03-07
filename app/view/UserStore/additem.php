<?php
$title = "Add-Product";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";




?>
        <div class="row">
            <div class="w-75  col-1 ">

                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Add new Product</h5>
                </div>

                <div class="modal-body">

                    <?php
                    if (!empty($_SESSION['alert'])){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo  $_SESSION['alert'];
                            unset($_SESSION['alert']);
                            ?>
                        </div>
                        <?php
                    }elseif (!empty($_SESSION['alert-suc'])){
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                            echo  $_SESSION['alert-suc'];
                            unset($_SESSION['alert-suc']);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <form method="post" action="<?=URLROOT?>UserItemsController/AddProduct" enctype="multipart/form-data">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" name="itemname"  placeholder="Item name" aria-label="" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control" name="itemdesc"  placeholder="Describe the Item" aria-label="" aria-describedby="basic-addon2" required ></textarea>
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-info-circle" aria-hidden="true"></i> </span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number" min="0" class="form-control" name="price"  placeholder="price" aria-label="" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="country"  placeholder="Country of Made" aria-label="" aria-describedby="basic-addon1" required>
                        </div>


                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-image" aria-hidden="true"> Item Image</i>
                        </span>
                            <input type="file" name="image" class="form-control"  required>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-battery-half" aria-hidden="true"></i></span>
                            <select class="form-control"  name="status" required>
                                <option hidden>Status ↓  </option>
                                <option value="New">New</option>
                                <option value="Like-New">Like New</option>
                                <option value="Used">Used</option>
                                <option value="Old">Old</option>
                                <option value="Very-Old">Very-Old</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                            <select class="form-control"  name="category" required>
                                <option hidden>Categories ↓  </option>
                                <?php
                                if (!empty($data)){
                                    foreach ($data as $categ){
                                        ?>
                                        <option value="<?=$categ->categid?>"><?=$categ->categname?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" >Add Product</button>
                </div>
                </form>
            </div>
        </div>



<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




