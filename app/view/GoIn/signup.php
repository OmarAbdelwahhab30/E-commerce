<?php
require_once INCLUDES_PATH."/header.php";
?>
<div style="background-color: #eee; height: 107px">

</div>
<div class="vh-400"  style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">

                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">

                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <?php
                                if (!empty($_SESSION['alert'])){
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <?=$_SESSION['alert']?>
                                </div>
                                <?php
                                unset($_SESSION['alert']);
                                }
                                ?>
                                <form method="post" action="<?=URLROOT?>SignUpController/index" enctype="multipart/form-data" class="mx-1 mx-md-4">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text"
                                                   class="form-control"
                                                   id="username" name="username"
                                                   placeholder="Enter username"
                                                   onkeyup="ValidateUsername(this.value)"
                                                   oninput="ValidateUsername(this.value)"
                                                   onchange="ValidateUsername(this.value)"
                                                   onmouseover="ValidateUsername(this.value)"
                                                   required
                                            >
                                            <script>
                                                function ValidateUsername(value) {
                                                    if (value.length>=4) {
                                                        $.ajax({
                                                            url: `<?=URLROOT?>SignUpController/IsValidUsername/${value}`,
                                                            dataType: "json",
                                                            cache: false,
                                                            success: function (data, status) {
                                                                if (JSON.parse(data) === true) {
                                                                    if ($('#username').hasClass('form-control') || $('#username').hasClass('form-control is-invalid')) {
                                                                        $('#username').removeClass('form-control');
                                                                        $('#username').removeClass('form-control is-invalid');
                                                                        $('#username').addClass('form-control is-valid');
                                                                    }
                                                                } else {
                                                                    if ($('#username').hasClass('form-control') || $('#username').hasClass('form-control is-valid')) {
                                                                        $('#username').removeClass('form-control');
                                                                        $('#username').removeClass('form-control is-valid');
                                                                        $('#username').addClass('form-control is-invalid');
                                                                    }
                                                                }
                                                            }
                                                        })
                                                    }

                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email"
                                                   class="form-control"
                                                   id="email" name="email"
                                                   placeholder="Enter Your Email"
                                                   onkeyup="ValidateEmail(this.value)"
                                                   oninput="ValidateEmail(this.value)"
                                                   onchange="ValidateEmail(this.value)"
                                                   onmouseover="ValidateEmail(this.value)"
                                                   required>
                                            <script>
                                                function ValidateEmail(value) {
                                                    if (value.length>=8) {
                                                        $.ajax({
                                                            url: `<?=URLROOT?>SignUpController/IsValidEmail/${value}`,
                                                            dataType: "json",
                                                            cache: false,
                                                            success: function (data, status) {
                                                                if (JSON.parse(data) === true) {
                                                                    if ($('#email').hasClass('form-control') || $('#email').hasClass('form-control is-invalid')) {
                                                                        $('#email').removeClass('form-control');
                                                                        $('#email').removeClass('form-control is-invalid');
                                                                        $('#email').addClass('form-control is-valid');
                                                                    }
                                                                }else {
                                                                    if ($('#email').hasClass('form-control') || $('#email').hasClass('form-control is-valid')) {
                                                                        $('#email').removeClass('form-control');
                                                                        $('#email').removeClass('form-control is-valid');
                                                                        $('#email').addClass('form-control is-invalid');
                                                                    }
                                                                }
                                                            }
                                                        })
                                                    }

                                                }

                                            </script>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password"
                                                   class="form-control"
                                                   id="password"
                                                   name="password"
                                                   placeholder="Enter your password"
                                                   onkeyup="ValidatePassword(this.value)"
                                                   oninput="ValidatePassword(this.value)"
                                                   onchange="ValidatePassword(this.value)"
                                                   onmouseover="ValidatePassword(this.value)"

                                                   required>
                                            <script>
                                                function ValidatePassword(value) {
                                                    if (value.length>=8) {
                                                        $.ajax({
                                                            url: `<?=URLROOT?>SignUpController/IsValidPassword/${value}`,
                                                            dataType: "json",
                                                            cache: false,
                                                            success: function (data, status) {
                                                                if (JSON.parse(data) === true) {
                                                                    if ($('#password').hasClass('form-control') || $('#password').hasClass('form-control is-invalid')) {
                                                                        $('#password').removeClass('form-control');
                                                                        $('#password').removeClass('form-control is-invalid');
                                                                        $('#password').addClass('form-control is-valid');
                                                                    }
                                                                }else {
                                                                    if ($('#password').hasClass('form-control') || $('#password').hasClass('form-control is-valid')) {
                                                                        $('#password').removeClass('form-control');
                                                                        $('#password').removeClass('form-control is-valid');
                                                                        $('#password').addClass('form-control is-invalid');
                                                                    }
                                                                }
                                                            }
                                                        })
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password"
                                                   class="form-control"
                                                   id="repassword"
                                                   onkeyup="ValidateMatching()"
                                                   name="repassword"
                                                   placeholder="repeat your password"
                                                   required>
                                            <script>
                                                function ValidateMatching()
                                                {
                                                    if ($("#password").val() == $("#repassword").val()) {
                                                        if ($('#repassword').hasClass('form-control') || $('#repassword').hasClass('form-control is-invalid')) {
                                                            $('#repassword').removeClass('form-control');
                                                            $('#repassword').removeClass('form-control is-invalid');
                                                            $('#repassword').addClass('form-control is-valid');
                                                        }
                                                    }else{
                                                        if ($('#repassword').hasClass('form-control') || $('#repassword').hasClass('form-control is-valid')) {
                                                            $('#repassword').removeClass('form-control');
                                                            $('#repassword').removeClass('form-control is-valid');
                                                            $('#repassword').addClass('form-control is-invalid');
                                                        }
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <script>

                                    </script>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="date" name="dob" id="form3Example4cd" max="<?=date('Y-m-d')?>" class="form-control" placeholder="Enter your date of birth"/>
                                            <label class="form-label" for="form3Example4cd"></label>
                                        </div>

                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-image" aria-hidden="true"> Profile Image</i>
                                        </span>
                                        <input type="file" name="image" class="form-control" onchange="loadFile(event)" >
                                        <script>
                                            var loadFile = function(event) {
                                                var image = document.getElementById('image');
                                                image.src = URL.createObjectURL(event.target.files[0]);
                                                image.style.height = "600px";
                                                image.style.width = "600px";
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
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit"  class="btn btn-primary btn-lg">Register</button>
                                    </div>
                                </form>
                                <hr class="my-4">
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <a  type="button" href="<?=URLROOT?>" class="btn btn-success">Do you have an account ?</a>

                                </div>
                                <div>
                                    <a href="<?=URLROOT?>" type="button" class="btn btn-dark" style="margin-left: 90px">Return home page</a>
                                </div>
                            </div>

                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="" class="img-fluid" id="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background-color: #eee; height:107px">
</div>
<?php
require_once INCLUDES_PATH."/footer.php";
?>
