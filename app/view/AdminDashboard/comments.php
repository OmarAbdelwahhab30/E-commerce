<?php
$title = "Comments";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";


?>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="border-bottom rounded">
                    <?php
                    if (!empty($data['item'])){
                      ?>
                    <div class="row">
                        <div class="col">
                            <img style="margin-left: 270px"  class="rounded"
                                 src="<?=URLROOT?><?=$data['item']->img?>"
                                 width="350px" height="350px"
                                 alt="alt">
                        </div>
                        <div class="border-top m-2">
                            <div class="col">
                                <h6>
                                    Product-Name :
                                    <small class="text-muted"><?=$data['item']->name?></small>
                                </h6>
                                <h6>
                                    Description :
                                    <small class="text-muted"><?=$data['item']->description?></small>
                                </h6>
                                <h6>
                                    Price :
                                    <small class="text-muted"><?=$data['item']->price?></small>
                                </h6>
                                <h6>
                                    Country_Made :
                                    <small class="text-muted"><?=$data['item']->country_made?></small>
                                </h6>
                                <h6>
                                    Status :
                                    <small class="text-muted"><?=$data['item']->status?></small>
                                </h6>

                            </div>
                        </div>
                    </div>
                </div>
                            <?php
                                }
                            ?>
                <div class="headings d-flex justify-content-between align-items-center mb-3">
                    <h5> Product-Comments</h5>
                </div>
                <?php
                if (!empty($data['comments'])){
                foreach ($data['comments'] as $comment){
                $src = !isset($comment->img)? 'assets/img/img_avatar.png': $comment->img
                ?>
                <div class="mb-xl-5">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">

                                <img style="margin: 0px 10px 20px 0px;"
                                     src="<?=URLROOT.$src?>"
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
                                <a class="text-decoration-none text-primary" href="<?=URLROOT?>AdminCommentsController/RemoveComment/<?=$comment->commentid?>/<?=$data['item']->itemid?>">Remove</a>
                                <a class="text-decoration-none text-primary" href="#" data-bs-toggle="modal" data-bs-target="#te" onclick="$('#textareacomment').val(`<?=$comment->comment?>`);" id="editc"  >Edit</a>
                                <script>
                                    var comment ;
                                    $("#editc").click(function () {
                                        $('#HiddenInputComment').val('<?=$comment->commentid?>')
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                }
                }else{
                    ?>
                    <div class="alert alert-info" role="alert">
                        No Comments To show
                    </div>
                        <?php
                }
                ?>
                <!---- Start Pagination ---->
                <div class="mx-5">
                    <nav   aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php

                            if (!empty($data2)) {
                                if ($data2['PagesNum'] > 1){
                                    for($page = 1; $page<=$data2['PagesNum']; $page++) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?=URLROOT?>AdminCommentsController/Comments/<?=$page?>/<?=$data['item']->itemid?>">
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
                    <form method="post" action="<?=URLROOT?>AdminCommentsController/AddComment/<?=$data['item']->itemid?>/<?=$_SESSION['userid']?>">
                        <textarea class="form-control"  placeholder="Enter Your Comment Here" style="resize: none" name="comment"></textarea>
                        <input class="btn btn-dark mt-3" type="submit" name="Post" value="Post">
                        <hr>
                    </form>
                </div>
            </div>

        </div>

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
                    <form method="post" action="<?=URLROOT?>AdminCommentsController/EditComment">
                        <textarea class="form-control" id="textareacomment" name="Updatedcomment"></textarea>
                        <input type="hidden" id="HiddenInputComment" name="commentid">
                        <input type="hidden" id="HiddenInputComment" name="itemid" value="<?=$data['item']->itemid?>">
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
require_once INCLUDES_ADMIN_PATH."/footer.php";
