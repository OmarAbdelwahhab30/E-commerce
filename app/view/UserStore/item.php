<?php
$title = "Profile";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";
?>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="col">
                     <img id="myImg" class="mt-3" style="border-radius: 10px ;width: 100%;height: 100%"   src="<?=URLROOT.$data->img?>">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$data->name?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Description</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$data->description?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Price</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$data->price?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Country-Made</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$data->country_made?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=$data->status?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-warning ml-2 "
                                       href="#">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php
            if (isset($_SESSION[0]['allowcomment']) && $_SESSION[0]['allowcomment']){
            ?>
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5> Product-Comments</h5>
            </div>
                  <div class="mb-xl-5">
                      <?php
                      if (!empty($data2['AllComments'])){
                        foreach ($data2['AllComments'] as $comment){

                      ?>
                        <div class="card p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center">

                                    <img style="margin: 0px 10px 20px 0px;"
                                         src="<?=URLROOT.$comment->img?>"
                                         width="30"
                                         class="user-img rounded-circle mr-2">
                                    <span>
                                    <small class="font-weight-bold text-dark"><?=$comment->username?></small><br>
                                    <small class="text-start text-muted"><?=$comment->comment?></small>
                                </span>
                                </div>
                                <small><?=$comment->date?></small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4">

                                    <?php
                                    if ($comment->userid == $_SESSION['userid'] || $_SESSION['roles'] == "1"){
                                    ?>
                                        <a class="text-decoration-none text-primary"
                                           href="<?=URLROOT?>UserCommentsController/RemoveComment/<?=$comment->commentid?>/<?=$data->itemid?>">
                                            Remove
                                        </a>
                                        <a class="text-decoration-none text-primary" href="#" data-bs-toggle="modal" data-bs-target="#te"
                                           onclick="$('#textareacomment').val(`<?=$comment->comment?>`);" id="editc"  >Edit</a>
                                        <script>
                                            var comment ;
                                            $("#editc").click(function () {
                                                $('#HiddenInputComment').val('<?=$comment->commentid?>')
                                            });
                                        </script>                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
<hr>
                            <?php
                        }
                      }else{
                          ?>
                          <div class="alert alert-info" role="alert">
                              There is no Comments To show
                          </div>
                              <?php
                      }
                            ?>

                  </div>

            <!---- Start Pagination ---->
            <div class="mx-5">
                <nav   aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        if (!empty($data3)) {
                            if ($data3['PagesNum'] > 1){
                                for($page = 1; $page<=$data3['PagesNum']; $page++) {?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=URLROOT?>UserItemsController/Item/<?=$data->itemid?>/<?=$page?>">
                                            <?=$page?>
                                        </a>
                                    </li>
                                <?php }
                            }
                        }
                        ?>

                    </ul>
                </nav>
            </div>
            <!---- End Pagination ---->

            <div>
                <form method="post" action="<?=URLROOT?>UserCommentsController/AddComment/<?=$data->itemid?>/<?=$_SESSION['userid']?>">
                    <textarea class="form-control"  placeholder="Enter Your Comment Here" style="resize: none" name="comment"></textarea>
                    <input class="btn btn-dark mt-3" type="submit" name="Post" value="Post">
                    <hr>
                </form>
            </div>


            <!--EditCommentModal -->
            <div class="modal" tabindex="-1" id="te">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit a Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?=URLROOT?>UserCommentsController/EditComment">
                                <textarea class="form-control" id="textareacomment" name="Updatedcomment"></textarea>
                                <input type="hidden" id="HiddenInputComment" name="commentid">
                                <input type="hidden" id="HiddenInputComment" name="itemid" value="<?=$data->itemid?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                <?php
            }
                ?>


        </div>
    </div>

<?php
require_once INCLUDES_USER_PATH."/footer.php";
