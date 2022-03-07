<?php
$title = "Categories";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>

<script>
    var categoryID;
    function DeleteCategory(){
        $.ajax({
            url:`<?=URLROOT?>AdminCategoryController/DeleteCategory/${categoryID}`,
            dataType:'json',
            cache:false,
            success:function (data,status) {
                var content;
                if (JSON.parse(data)==false){
                        content = "<div class='alert alert-danger' role='alert'>"+"Something went wrong"+"</div>"
                }else {
                        content = "<div class='alert alert-success' role='alert'>"+"Category has been deleted successfully"+"</div>"
                }
                $("#deleteresult").html(content);
            }
        })
    }
</script>
        <div class="container ">
            <div class="modal-header">
                <a href="<?=URLROOT?>AdminCategoryController/AddCategoryView" class="btn btn-outline-dark" id="exampleModalLabel">Add new Category  </a>
            </div>

            <!-- Category Tables -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
                </div>
                <div id="deleteresult">

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Visibility</th>
                                <th>Comments</th>
                                <th>Ads</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($data)){
                                foreach ($data as $categ){
                                    ?>
                                    <tr>
                                        <td><?=$categ->categname?></td>
                                        <td class="w-25"><?=$categ->description?></td>
                                        <td><?=$categ->visibility?></td>
                                        <td><?=$categ->allowcomment?></td>
                                        <td><?=$categ->allowAds?></td>
                                        <td><a href="<?=URLROOT?>AdminCategoryController/UpdateCategoryView/<?=$categ->categid?>" class="btn btn-dark">Edit</a> <a href="#" onclick="categoryID=<?=$categ->categid?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteCategoryModal">Delete</a></td>
                                    </tr>
                                        <?php
                                }
                            }else{
                                ?>
                            <tr>
                                <td colspan="7">No category to show</td>
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
                                            <li class="page-item"><a class="page-link" href="<?=URLROOT?>AdminCategoryController/ManageCategoryView/<?=$page?>"><?=$page?></a></li>
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

    <!--Delete category  Modal -->
    <div class="modal fade" id="DeleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete A Category !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure To delete this category ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="DeleteCategory()" data-bs-dismiss="modal" >Delete</button>
                </div>
            </div>
        </div>
    </div>
<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




