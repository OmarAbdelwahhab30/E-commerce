<?php
$title = "Categories";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>

    <div class="container ">

        <div class="w-50 mx-auto ">
            <div class="modal-header">
                <a href="<?=URLROOT?>AdminCategoryController/ManageCategoryView/1" class="btn btn-primary" id="exampleModalLabel">Manage Category Page </a>
            </div>
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Add new Category</h5>
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
                <form method="post" action="<?=URLROOT?>AdminCategoryController/AddNewCategory">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" name="categname"  placeholder="name of the category" aria-label="" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" name="categdesc"  placeholder="Describe the category" aria-label="" aria-describedby="basic-addon2" ></textarea>
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-info-circle" aria-hidden="true"></i> </span>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="border rounded p-lg-3 mb-lg-3">
                            <h4>Visibility</h4>
                            <div class="form-check">
                                yes <input class="form-check-input" value="yes" type="radio" name="visibility" id="flexRadioDefault1">

                            </div>
                            <div class="form-check">
                                No <input class="form-check-input" value="no" type="radio" name="visibility" id="flexRadioDefault2" checked>

                            </div>
                        </div>

                        <div class="border rounded p-lg-3 mb-lg-3">
                            <h4>Allowing Comments</h4>
                            <div class="form-check">
                                yes <input class="form-check-input" value="yes" type="radio" name="comments" id="flexRadioDefault3">

                            </div>
                            <div class="form-check">
                                No <input class="form-check-input" value="no" type="radio" name="comments" id="flexRadioDefault4" checked>

                            </div>
                        </div>

                        <div class="border rounded p-lg-3 mb-lg-3">
                            <h4>Allowing Ads</h4>
                            <div class="form-check">
                                yes <input class="form-check-input" value="yes" type="radio" name="ads" id="flexRadioDefault5">

                            </div>
                            <div class="form-check">
                                No <input class="form-check-input" value="no" type="radio" name="ads" id="flexRadioDefault6" checked>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Add Category</button>
            </div>

            </form>
        </div>

    </div>

<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




