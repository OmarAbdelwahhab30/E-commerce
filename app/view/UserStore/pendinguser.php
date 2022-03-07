<?php
$title = "PendingUser";
require_once INCLUDES_USER_PATH."/header.php";
?>
<div class="container-fluid w-75">
    <div class="alert alert-info mt-5" role="alert">
        <h3 class="text-center text-dark">Your membership is pending, you will be taken directly to the main page once you are approved by the administration</h3>
    </div>
    <div class="p-lg-3">
        <a href="<?=URLROOT?>IndexController/logout" class="btn btn-dark">Go To Home Page</a>
    </div>
</div>
<?php
require_once INCLUDES_USER_PATH."/footer.php";

