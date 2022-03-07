<?php
$title = "Edit Profile";
require_once INCLUDES_USER_PATH."/header.php";
require_once INCLUDES_USER_PATH."/sidebar.php";
require_once INCLUDES_USER_PATH."/nav.php";
?>
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?=URLROOT.$_SESSION['img']?>" alt="Admin" id="image" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?=$_SESSION['username']?></h4>
                            <p class="text-secondary mb-1"><?=($_SESSION['roles']!="1")?"Customer":"Admin"?></p>
                            <p class="text-muted font-size-sm"><?=$_SESSION['email']?></p>
                            <?php
                            if ($_SESSION['img'] != '/assets/img/img_avatar.png'){
                                ?>
                                <a href="<?=URLROOT?>UserEditProfileController/DeleteProfilePic" class="text-danger text-decoration-none">Delete Profile Picture</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">

            </div>
        </div>
        <div class="col-md-8">
            <?php
            if (!empty($_SESSION['alert'])){
              ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_SESSION['alert']?>
                </div>
                <?php
                unset($_SESSION['alert']);
            }elseif(!empty($_SESSION['alert-suc'])){
                ?>
                <div class="alert alert-success" role="alert">
                    <?=$_SESSION['alert-suc']?>
                </div>
                <?php
                unset($_SESSION['alert-suc']);
            }
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="<?=URLROOT?>UserEditProfileController/EditProfileInfo" method="post"  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mt-2">username</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" placeholder="<?=$_SESSION['username']?>" class="form-control" name="username" >
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" placeholder="<?=$_SESSION['email']?>" name="email">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Date-Of-Birth</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="date" class="form-control"  name="dob" >
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Old password</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="oldpass" >
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">new password</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="newpass" >
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Repeat new Password</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="confirmnewpass" >
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Update Image</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="file" name="image" class="form-control" onchange="loadFile(event)" >
                            <script>
                                var loadFile = function(event) {
                                    var image = document.getElementById('image');
                                    image.src = URL.createObjectURL(event.target.files[0]);

                                    image.className ="float-end"
                                    image.style.borderRadius="50%";
                                    image.onload = function() {
                                        URL.revokeObjectURL(image.src)
                                    }
                                };
                            </script>                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-success"
                               href="" name="submit" value="Update">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";





