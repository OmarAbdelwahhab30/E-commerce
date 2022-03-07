<?php
$title = "Items";
require_once INCLUDES_ADMIN_PATH."/header.php";
require_once INCLUDES_ADMIN_PATH."/nav.php";



?>

    <div class="container ">
        <div class="row">
         <div class="w-50 mx-5 col-1 ">

            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Add new Item</h5>
            </div>

            <div class="modal-body">

                <?php
                if (!empty($_SESSION['alert'])){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo  $_SESSION['alert'];
                        unset($_SESSION['alert']);
                        ?>
                    </div>
                    <?php
                }elseif (!empty($_SESSION['alert-suc'])){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo  $_SESSION['alert-suc'];
                        unset($_SESSION['alert-suc']);
                        ?>
                    </div>
                    <?php
                }
                ?>
                <form method="post" action="<?=URLROOT?>AdminItemsController/AddNewItem" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" name="itemname"  placeholder="Item name" aria-label="" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" name="itemdesc"  placeholder="Describe the Item" aria-label="" aria-describedby="basic-addon2" required ></textarea>
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-info-circle" aria-hidden="true"></i> </span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="number" min="0" class="form-control" name="price"  placeholder="price" aria-label="" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="country"  placeholder="Country of Made" aria-label="" aria-describedby="basic-addon1" required>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-image" aria-hidden="true"> Item Image</i>
                        </span>
                        <input type="file" name="image" class="form-control" onchange="loadFile(event)" required>
                        <script>
                            var loadFile = function(event) {
                                var image = document.getElementById('image');
                                image.src = URL.createObjectURL(event.target.files[0]);
                                image.style.height = "250px";
                                image.style.width = "280px";
                                image.className ="float-end"
                                image.style.borderRadius="4px";
                                image.style.marginTop = "210px";
                                image.onload = function() {
                                    URL.revokeObjectURL(image.src)
                                }
                            };
                        </script>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-battery-half" aria-hidden="true"></i></span>
                        <select class="form-control"  name="status" required>
                            <option hidden>Status ↓  </option>
                            <option value="New">New</option>
                            <option value="Like-New">Like New</option>
                            <option value="Used">Used</option>
                            <option value="Old">Old</option>
                            <option value="Very-Old">Very-Old</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        <select class="form-control"  name="category" required>
                            <option hidden>Categories ↓  </option>
                            <?php
                            if (!empty($data)){
                                foreach ($data as $categ){
                                    ?>
                            <option value="<?=$categ->categid?>"><?=$categ->categname?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                        <input  type="text" id="username" class="form-control" oninput="GetUser(this.value)" name="username"  placeholder="User Name" aria-label="" aria-describedby="basic-addon1" required>
                        <input type="hidden" value="" name="userid">
                    </div>
                    <script>
                        var content = "";
                        var userid ;
                        function GetUser(username) {
                            if (username.length > 4){
                                $.ajax({
                                    url: `<?=URLROOT?>AdminItemsController/GetUserData/${username}`,
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data, status) {
                                        if (typeof (data) == 'string') {
                                            content = '<div class="card shadow mb-4">' +
                                                '<div class="card-body">' +
                                                '<div class="chart-area">' +
                                                '<div class="">' +
                                                data +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>'
                                        } else {
                                            userid = data.userid;
                                            content = '<div class="card shadow mb-4">' +
                                                '<div class="card-body">' +
                                                '<div class="chart-area">' +
                                                '<div class="">' +
                                                '<img  height="40px" style="border-radius: 50%" src="<?=URLROOT?>'+ data.img+'" alt="avatar">' +
                                                '<span> ' + data.username + '</span>'+
                                                '<a   id ="btnselect" onclick="Selectedbtn()" class="btn btn-outline-dark float-end" >' + 'Select' + '</a>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>'
                                        }
                                        $("#ResultUser").html(content);
                                    }
                                })
                            }
                        }

                        function Selectedbtn() {
                            $("#btnselect").removeClass("btn btn-outline-dark float-end").addClass("btn btn-success float-end").html("Selected");
                            $("input[name='userid']").val(userid);
                        }
                    </script>
                    <div id="ResultUser">

                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" >Add Item</button>
            </div>
            </form>
        </div>

            <div class="col-2">
                <div style="width: 200px;">
                    <img id="image"/>
                </div>
            </div>
        </div>


    </div>

<?php
require_once INCLUDES_ADMIN_PATH."/footer.php";




