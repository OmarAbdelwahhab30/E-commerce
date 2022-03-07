<?php
$title = "Members";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><span>Pending</span> <b style="color: #000000"> Customers</b></h2></div>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>userID</th>
                    <th>Username</i></th>
                    <th>date-of-birth</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <?php
                        if (!empty($data)){
                            foreach ($data as $user){?>
                                 <td><img height='40px' style='border-radius: 50%' src='<?=URLROOT.$user->img?>' alt='avatar'></td>
                                 <td><?=$user->userid?></td>
                                 <td><?=$user->username?></td>
                                 <td><?=$user->dob?></td>
                                 <td><?=$user->email?></td>
                                 <td>
                                     <button class="btn btn-light"  id="<?=$user->username?>" onclick="ActivateUser(<?=$user->userid?>);ActivatedBtn(this.id)">
                                         Activate
                                     </button>
                                     <button class="btn btn-warning" id="<?=$user->userid?>" onclick="RejectedBtn(this.id)">
                                         reject
                                     </button>
                                 </td>
                                <script>
                                    function ActivatedBtn(id){
                                        $("#"+id).removeClass( "btn btn-light" ).addClass("btn btn-success");
                                        $("#"+id).html('Activated');
                                        $("#"+id).next().remove()
                                    }
                                    function RejectedBtn(id){
                                        $("#"+id).removeClass( "btn btn-warning" ).addClass("btn btn-danger");
                                        $("#"+id).html('Rejected');
                                        $("#"+id).prev().remove();
                                    }
                                    function ActivateUser(userid) {
                                        $.ajax({
                                            url:`<?=URLROOT?>AdminMembersController/ActivateUser/${userid}`,
                                            dataType:"json",
                                            cache:false,
                                            success: function (data,status) {
                                                if (JSON.parse(data) === true){

                                                }
                                            }
                                        })
                                    }
                                </script>
                </tr>
                <?php }
                        }else{
                            ?>
                            <td colspan="6">There is no pending Users</td>
                <?php }
                    ?>
                </tbody>
            </table>
            <div class="clearfix">
            </div>
        </div>

    </div>
</div>


