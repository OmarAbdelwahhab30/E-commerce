<?php
$title = "Members";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";
?>
    <script>
        function DeleteMember(value) {
            $.ajax({
                url:`<?=URLROOT?>AdminMembersController/DeleteCustomer/${value}`,
                dataType:"json",
                cache:false,
                success:function (data, status) {
                    let content2 = "";
                    if (typeof(data) == 'string'){
                        content2 = '<div class="alert alert-success" role="alert">'+ 'The customer has been deleted succussfully' +'</div>';
                        getUserData(value);
                    }else {
                        content2 = '<div class="alert alert-danger" role="alert">'+ 'SomeThing Went Wrong' +'</div>';
                    }
                    $("#result").html(content2);
                }
            })
        }
        var username ;
        var dob ;
        var email ;
        var userid ;
        var regstatus ;
        var truststatus;
        var role ;
        var blocked;
        var blockStatus;
        var img;
        function getUserData(value) {
             ID = value;
            $.ajax({
                url:`<?=URLROOT?>AdminMembersController/ReturnUser/${value}`,
                dataType:"json",
                cache:false,
                success:function (data, status) {
                    let content = "";
                    if (typeof (data) == 'string') {
                        content = "<td colspan='9'>" + data + "</td>";
                    } else {
                        console.log(data)
                        userid = data.userid;
                        username = data.username;
                        dob = data.dob;
                        email = data.email;
                        regstatus = data.regstatus;
                        truststatus = data.truststatus;
                        blocked  = data.blocked ;
                        $("input[id='username']").val(username);
                        $("label[id='usernamelabel']").html(username);
                        $("input[id='email']").val(email);
                        $("label[id='Emaillabel']").html(email);
                        $("label[id='doblabel']").html(dob);
                        $("label[id='reglabel']").html(regstatus);
                        $("label[id='trustlabel']").html(truststatus);
                        $("input[id='CustHidden']").val(userid);
                        const info = [];
                        info.push(userid, username, dob, email, regstatus, truststatus);
                        $('#CustInfo').val(JSON.stringify(info));
                          role = (data.roles === '0') ? 'Customer' : 'Admin';
                          blockStatus = (blocked === '0')? 'None':'blocked';
                          regstatus = (regstatus === '0')? 'Still Pending':'Active';
                        for (let x in data) {
                            content =
                                "<td>" +
                                "<img  height='40px' style='border-radius: 50%' src='<?=URLROOT?>"+data.img +"'alt='avatar'>"
                                + "</td>"
                                + "<td>" + data.userid + "</td>"
                                + "<td>" + regstatus + "</td>"
                                + "<td>" + data.username + "</td>"
                                + "<td>" + data.dob + "</td>"
                                + "<td>" + data.email + "</td>" +
                                '<td>' + blockStatus + '</td>' +
                                '<td>' + role + '</td>' +
                                '<td>' +
                                '<a href="#" class="view" title="view">' +
                                '<button style="background-color: transparent;background-repeat: no-repeat;border: none;' +
                                'cursor: pointer;overflow: hidden;outline: none;"  data-bs-toggle="modal" data-bs-target="#viewModal">' +
                                '<i style="color:#4f81c7" class="fa fa-eye" aria-hidden="true">' + '</i>' +
                                '</button>' +
                                '<a href="#" class="edit" title="Edit">' +
                                '<button style="background-color: transparent;background-repeat: no-repeat;border: none;' +
                                'cursor: pointer;overflow: hidden;outline: none;"  data-bs-toggle="modal" data-bs-target="#MyModal">' +
                                '<i style="color:#1d9d73" class="fa fa-pencil-square-o" aria-hidden="true">' + '</i>' +
                                '</button>' +
                                '</a>' +
                                '<a href="#" class="delete" title="Delete">' +
                                '<button style="background-color: transparent;background-repeat: no-repeat;border: none;cursor: ' +
                                'pointer;overflow: hidden;outline: none;"  data-bs-toggle="modal" data-bs-target="#DeleteModal">' +
                                '<i style="color:red" class="fa fa-trash" aria-hidden="true">' +
                                '</i>'
                                + '</button>' +
                                '</a>' +
                                '<a href="#" title="Set As Admin">' +
                                '<button style="background-color: transparent;background-repeat: no-repeat;' +
                                'border: none;cursor: pointer;overflow: hidden;outline: none;" data-bs-toggle="modal" data-bs-target="#SetAdminModal">' +

                                '<i class="fa fa-user-secret" aria-hidden="true">' + '</i>' + '</button>' + '</a>' +
                                '<a href="#" title="Set As Admin">' +
                                '<button style="background-color: transparent;background-repeat: no-repeat;' +
                                'border: none;cursor: pointer;overflow: hidden;outline: none;" data-bs-toggle="modal" data-bs-target="#BlockingModal">' +
                                '<i style="color:red" class="fa fa-ban" aria-hidden="true">' + '</i>' + '</button>' + '</a>' +
                                '</td>';
                        }
                    }
                    $("#UserDataresult").html(content);
                }
            })
        }
        function SetAdmin(value,role) {
            $.ajax({
                url:`<?=URLROOT?>AdminMembersController/ChangeRole/${value}/${role}`,
                dataType:"json",
                cache:false,
                success:function (data, status) {
                    let content3 = "";
                    if (typeof(data) == 'string'){
                        content3 = '<div class="alert alert-success" role="alert">'+ 'The member role has been Changed succussfully' +'</div>';
                        getUserData(value);
                    }else {
                        content3 = '<div class="alert alert-danger" role="alert">'+ 'SomeThing Went Wrong' +'</div>';
                    }
                    $("#result").html(content3);
                }
            })
        }

        function BlockingFunc(value,status) {
            $.ajax({
                url:`<?=URLROOT?>AdminMembersController/ChangeBanning/${value}/${status}`,
                dataType:"json",
                cache:false,
                success:function (data, status) {
                    let content3 = "";
                    if (typeof(data) == 'string'){
                        content3 = '<div class="alert alert-success" role="alert">'+ 'The member Restriction has been Changed succussfully' +'</div>';
                        getUserData(value);
                    }else {
                        content3 = '<div class="alert alert-danger" role="alert">'+ 'SomeThing Went Wrong' +'</div>';
                    }
                    $("#result").html(content3);
                }
            })
        }

    </script>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">

                        <div class="col-sm-8"><h2><span>Customer</span> <b style="color: #2c786c">Details</b></h2></div>
                            <div class="col-sm-8" id="result">

                                <?php
                                if (!empty($_SESSION['alert'])){
                                    ?>
                                    <div class="alert alert-success" role="alert"><?=$_SESSION['alert']?></div>
                                    <?php
                                    unset($_SESSION['alert']);
                                }
                                elseif (!empty($_SESSION['done'] )){
                                    ?>
                                    <div class="alert alert-success" role="alert"> The member has been updated successfully </div>
                                <?php }else if (!empty($_SESSION['notdone']))  { ?>
                                    <div class="alert alert-danger" role="alert">Something went wrong </div>
                                <?php  }
                                unset($_SESSION['done'],$_SESSION['notdone']);
                                ?>


                            </div>

                        <div class="col-sm-4">
                            <div class="search-box">
                                <input type="text" id="search"  onkeyup="getUserData(this.value)" class="form-control" placeholder="Enter CustomerID" autofocus >
                            </div>
                            <div style="margin-bottom:20px "></div>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>userID</th>
                        <th>Pending</th>
                        <th>Username</i></th>
                        <th>date-of-birth</th>
                        <th>Email</th>
                        <th>Banning</th>
                        <th>Member Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr  id="UserDataresult">


                        </tr>
                    </tbody>
                </table>
                <div class="clearfix">
                </div>
            </div>

        </div>
        <div class="mt-lg-5">
            <a href="#" class="btn btn-dark active" role="button" data-bs-toggle="modal" data-bs-target="#AddingNewMember" aria-pressed="true"> + Add New Member</a>
        </div>
        <div class="mt-lg-5">
            <a href="<?=URLROOT?>AdminMembersController/PendingUsersView" class="btn btn-primary active " role="button" aria-pressed="true"> View Pending Members</a>
        </div>
    </div>

    <!-- Edit Modal -->

    <form  id="search_form" action="<?=URLROOT?>AdminMembersController/EditMemberInfo"  method="post">
        <div class="modal fade" id="MyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input onkeyup="ValidateUsername(this.value,userid)" type="text" id="username" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <script>
                            function ValidateUsername(value,userid) {

                                    $.ajax({
                                        url: `<?=URLROOT?>AdminMembersController/IsValidUsername/${value}/${userid}`,
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
                        </script>
                        <input type="hidden" id="CustInfo" name="info">
                        <input type="hidden" id="CustHidden">
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control"  placeholder="User's Email"  aria-label="Recipient's username"  aria-describedby="basic-addon2" required>
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                        <div class="input-group mb-3">
                            <input type="date" name="dob"   class="form-control" placeholder="date of birth" aria-label="Date Of Birth" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="truststatus"  min="0" max="1" class="form-control" placeholder="Trust Status" aria-label="Trust Status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="sub"  class="btn btn-primary" data-bs-dismiss="modal" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Delete Modal  --->
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete a customer !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this customer !
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="DeleteMember(ID)" class="btn btn-danger" data-bs-dismiss="modal" >Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Set as admin modal--->
    <div class="modal fade" id="SetAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adminstrator Controller</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   Do you want to change his role ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="SetAdmin(ID,role)" data-bs-dismiss="modal" >Go</button>
                </div>
            </div>
        </div>
    </div>


    <!----Preview Account---->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mx-auto" style="width:250px">

                    <div class="col-md-6">
                            <img  height='200px' style='border-radius: 50%' src='<?=URLROOT?>assets/img/img_avatar.png' alt='avatar'>
                        </div>
                        <div class="ms-4">
                            <div class="col-12">
                                username: <label id="usernamelabel"></label>
                            </div>
                            <div class="col-12">
                                Email: <label id="Emaillabel"></label>
                            </div>
                            <div class="col-12">
                                date of birth: <label id="doblabel"></label>
                            </div>
                            <div class="col-12">
                                Trust Status: <label id="trustlabel"></label>
                            </div>
                            <div class="col-12">
                                Reg Status: <label id="reglabel"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Blocking modal--->
    <div class="modal fade" id="BlockingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Banning Controller</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to change his restriction ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success"  data-bs-dismiss="modal" onclick="BlockingFunc(ID,blockStatus)" >Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add new Member modal--->
    <div class="modal fade" id="AddingNewMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Add new Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <?php
                    if (!empty($_SESSION['alert-modal'])){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo  $_SESSION['alert-modal'];
                            unset($_SESSION['alert-modal']);
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form method="post" action="<?=URLROOT?>AdminMembersController/AddNewMember">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" name="username"  placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email"  placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" required>
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password"  placeholder="password" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="repassword"  placeholder="confirm password" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" class="form-control" name="dob" max="<?=date('Y-m-d')?>" placeholder="Date of Birth" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" >Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add new Member modal--->


    <!-- PendingMembers modal--->
    <div class="modal fade" id="PendingMembers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Members Controller</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <img  height="50px" style="border-radius: 50%" src="<?=URLROOT?>assets/img/img_avatar.png" alt="avatar" class="ml-xl-5">
                        <span style="font-size: 20px">Username</span>
                    <label id="s"></label>
                        <button type="submit" class="btn btn-success float-end text-center mt-2" id="pendingbtn">
                            Activate</button>
                        <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
           </div>
        </div>
    </div>


<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";

