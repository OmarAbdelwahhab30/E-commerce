<?php
require_once INCLUDES_PATH."/header.php";
?>
<section class="vh-100" style="background-color: #E4E4E4;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
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
                        <h3 class="mb-5">Sign in</h3>
                        <form method="post" action="<?=URLROOT?>SignInController/index">
                                <div class="form-outline mb-4">
                                    <input type="text"
                                           id="username"
                                           name="username"
                                           class="form-control"
                                           placeholder="Enter username"
                                           onkeyup="ValidateUsername(this.value)"
                                           onkeydown="out()"
                                           required>
                                </div>
                                <script>
                                    function ValidateUsername(value) {
                                        if (value.length>=4) {
                                            $.ajax({
                                                url: `<?=URLROOT?>SignInController/IsFoundUsername/${value}`,
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
                                    function out(){
                                        $('#username').removeClass('form-control is-valid');
                                        $('#username').removeClass('form-control is-invalid');
                                        $('#username').addClass('form-control');
                                    }
                                </script>
                                <div class="form-outline mb-4">
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           class="form-control"
                                           placeholder="Enter Password"
                                           onkeyup="ValidatePassword($('#username').val(),this.value)"
                                           onkeydown="out2()"
                                           required>
                                    <script>
                                        function ValidatePassword(username,password) {
                                                $.ajax({
                                                    url: `<?=URLROOT?>SignInController/UsernameVsPassword/${username}/${password}`,
                                                    dataType: "json",
                                                    cache: false,
                                                    success: function (data, status) {
                                                        if (JSON.parse(data) === true) {
                                                            if ($('#password').hasClass('form-control') || $('#password').hasClass('form-control is-invalid')) {
                                                                $('#password').removeClass('form-control');
                                                                $('#password').removeClass('form-control is-invalid');
                                                                $('#password').addClass('form-control is-valid');
                                                            }
                                                        } else {
                                                            if ($('#password').hasClass('form-control') || $('#password').hasClass('form-control is-valid')) {
                                                                $('#password').removeClass('form-control');
                                                                $('#password').removeClass('form-control is-valid');
                                                                $('#password').addClass('form-control is-invalid');
                                                            }
                                                        }
                                                    }
                                                })
                                        }
                                        function out2(){
                                            $('#password').removeClass('form-control is-valid');
                                            $('#password').removeClass('form-control is-invalid');
                                            $('#password').addClass('form-control');
                                        }
                                    </script>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>

                        <hr class="my-4">
                        <a class="btn btn-success" href="<?=URLROOT?>SignUpController/index">Create New Account !</a>
                        <hr class="w-50" style="margin-left: 100px">
                        <a class="btn btn-dark" href="<?=URLROOT?>">Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once INCLUDES_PATH."/footer.php";
?>
