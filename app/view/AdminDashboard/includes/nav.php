<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-xl ">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">E-store</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=URLROOT?>AdminHomeController/HomeView"><?=lang('HOME')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=URLROOT?>AdminCategoryController/ManageCategoryView/1"><?=lang('CATEGORIES')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=URLROOT?>AdminItemsController/ManageItems/1"><?=lang('ITEMS')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=URLROOT?>AdminMembersController/MembersView/"><?=lang('MEMBERS')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                </li>
            </ul>
        </div>
        <div class="btn-group">
            <i style="color: white;margin: 23px 2px 0 0;font-size: 9px" class="fa fa-sort-desc" aria-hidden="true"></i>
            <img  height="50px" style="padding-top: 10px ;border-radius: 50%" src="<?=URLROOT.$_SESSION['img']?>" alt="avatar"
                  class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?=URLROOT?>UserHomeController/index"><?=lang("Visit Shop")?></a></li>
                <li><a class="dropdown-item" href="<?=URLROOT?>AdminEditProfileController/EditProfileView"><?=lang("Edit Profile")?></a></li>
                <li>
                    <button class="dropdown-item" onclick="DeleteSessionCart();">
                        <a class="text-decoration-none text-black" href="<?=URLROOT?>IndexController/logout">
                            <?=lang("Logout")?>
                        </a>
                    </button>
                </li>
            </ul>

        </div>

    </div>
</nav>

<script>
    function DeleteSessionCart() {
        $.ajax({
            url: `<?=URLROOT?>UserPaymentController/DeleteSessionCart`,
            cache: false,
            success: function (data, status) {
                let content = "";
            }
        })
        localStorage.setItem("cartnum", 0);
    }
</script>

