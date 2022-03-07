<?php
$title = "Edit Profile";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img style="border-radius: 50% ; height: 250px;width: 250px" src="<?=URLROOT.$_SESSION['img']?>" id="image">
                    <span class="font-weight-bold"></span><span class="text-black-50"></span><span><?=$_SESSION['email']?> </span>
                    <?php
                    if ($_SESSION['img'] != "\assets\img\img_avatar.png"){
                    ?>
                    <a href="<?=URLROOT?>AdminEditProfileController/DeleteProfilePic" class="btn btn-danger">Delete Profile Picture</a>
                        <?php
                    }
                        ?>
                        </div>
            </div>
            <div class="col-md-5 border-right">

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>

                    </div>
                    <?php
                    if (!empty($_SESSION['alert'])){
                    ?>
                        <div class="alert alert-danger" id="alert" role="alert">
                            <?=$_SESSION['alert'];unset($_SESSION['alert'])?>
                        </div>
                        <?php
                        }else if (isset($_SESSION['alert-suc'])){?>
                        <div class="alert alert-success" id="alert" role="alert">
                            <?=$_SESSION['alert-suc'];unset($_SESSION['alert-suc'])?>
                        </div>
                          <?php
                    }
                        ?>
                   <hr>
                    <form method="post" action="<?=URLROOT?>AdminEditProfileController/UpdateProfileInfo/<?=$_SESSION['userid']?>" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Username</label><input type="text" id="username" name="username" class="form-control" value="<?=$_SESSION['username']?>" ></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Date Of Birth</label><input type="date" max="<?=date('Y-m-d')?>" id="dob" name="dob" class="form-control" value="" ></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" value="<?=$_SESSION['email']?>"> </div>
                            </div class="row mt-3">
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Old Password</label><input type="password" name="oldpass" class="form-control" placeholder="Enter Old Password"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">new Password</label><input type="password" name="newpass" class="form-control" placeholder="Enter new Password"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Confirm new Password</label><input type="password"  name="confirmnewpass" class="form-control" placeholder="Confirm new password" ></div>
                            </div>
                            <div class="row mt-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-image" aria-hidden="true"> Profile Image</i>
                                        </span>
                                <input type="file" name="image" class="form-control" onchange="loadFile(event)" >
                                <script>
                                    var loadFile = function(event) {
                                        var image = document.getElementById('image');
                                        image.src = URL.createObjectURL(event.target.files[0]);

                                        image.className ="float-end"
                                        image.style.borderRadius="50%";
                                        image.style.marginTop = "-14px";
                                        image.style.marginLeft = "50px";
                                        image.onload = function() {
                                            URL.revokeObjectURL(image.src)
                                        }
                                    };
                                </script>
                            </div>
                            </div>
                                <div class="mt-5 text-center"><button class="btn btn-dark profile-button" type="submit">Save Profile</button></div>
                            </div>
                </form>
            </div>
        </div>
    </div>

<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";





