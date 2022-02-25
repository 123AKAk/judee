<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/AdminModel.php';

    $sharedComponentsModel = new SharedComponents();
    $adminModel = new Admin();

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../includes//navbar.php'; ?>
                <!-- End of Topbar -->
                <div class="container-fluid">

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-xl-10">

                            <!-- Header -->
                            <div class="header">
                                <div class="header-body">
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <!-- Pretitle -->
                                            <h6 class="header-pretitle">
                                                Admin
                                            </h6>

                                            <!-- Title -->
                                            <h1 class="header-title" style="
                                  letter-spacing: -.02em;
                                  font-size: 1.625rem;
                              ">
                                                Settings
                                            </h1>

                                        </div>
                                    </div> <!-- / .row -->
                                    <div class="row align-items-center">
                                        <div class="col">

                                            <!-- Nav -->
                                            <ul class="nav nav-tabs nav-overflow header-tabs">
                                                <li class="nav-item">
                                                    <a onclick="toogleSettingTab(1)" href="javascript:void(0)"
                                                        class="nav-link active" id="lcp-nav-tab1" data-bs-toggle="pill"
                                                        data-bs-target="#lcp-body-tab1" role="tab"
                                                        aria-controls="lcp-body-tab1" aria-selected="true">
                                                        Site Info
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a onclick="toogleSettingTab(2)" href="javascript:void(0)"
                                                        class="nav-link" id="lcp-nav-tab2" data-bs-toggle="pill"
                                                        data-bs-target="#lcp-body-tab2" role="tab"
                                                        aria-controls="lcp-body-tab2" aria-selected="false">
                                                        Password
                                                    </a>
                                                </li>


                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade show active" id="lcp-body-tab1" role="tabpanel"
                                aria-labelledby="lcp-nav-tab1">
                                <div class="row gutters">
                                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                        <div class="card procard h-100">
                                            <div class="card-body">
                                                <div class="account-settings">
                                                    <div class="user-profile">
                                                        <div class="user-avatar">
                                                            <img src="<?php echo (!empty("")) ? '../uploads/images'.$image : '../img/default.png';?>">
                                                        </div>
                                                        <h5 class="user-name"></h5>
                                                        <h6 class="user-email"></h6>
                                                    </div>
                                                    <div class="about">
                                                        <h5>Annibel Jewelry & Collections</h5>
                                                        <p>“I’ve always had a love of natural gemstones, and noticed a white space in the jewelry market for quality styles and stones at an affordable price. So, I decided to create them myself.”</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="row gutters">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <h6 class="mb-2 text-primary">Site Details</h6>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label>Author</label>
                                                            <input class="form-control proform-control" placeholder="Author">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control proform-control" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input type="tel" class="form-control proform-control" placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gutters">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label>About</label>
                                                            <textarea class="form-control proform-control" rows="4" placeholder="About"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Tags</label>
                                                            <input type="text" class="form-control proform-control" placeholder="Site Tags">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Meta Data</label>
                                                            <input type="text" class="form-control proform-control" placeholder="Site Meta Data">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control proform-control" placeholder="Site Title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gutters">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="text-right">
                                                            <button type="button" id="submit" name="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show d-none" id="lcp-body-tab2" role="tabpanel"
                                aria-labelledby="lcp-nav-tab2">

                                <!-- Form -->
                                <form asp-action="changepassword" id="changepassword" asp-controller="account"
                                    data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete"
                                    data-ajax-begin="main.AjaxOnBegin" data-ajax-success="main.AjaxOnUpdateSucess"
                                    data-ajax-failure="main.AjaxOnfailure" class="mb-4">

                                    <div class="row">
                                        <div class="col-12 col-md-6">

                                            <!-- Password -->
                                            <div class="form-group">
                                                <!-- Label -->
                                                <label>
                                                    Current Password
                                                </label>
                                                <!-- Input -->
                                                <input asp-for="CurrentPassword" type="password" class="form-control" />
                                            </div>

                                            <!-- New password -->
                                            <div class="form-group">
                                                <!-- Label -->
                                                <label>
                                                    New password
                                                </label>
                                                <!-- Input -->
                                                <input asp-for="Password" type="password" class="form-control" />
                                            </div>

                                            <!-- Confirm new password -->
                                            <div class="form-group">
                                                <!-- Label -->
                                                <label>
                                                    Confirm new password
                                                </label>
                                                <!-- Input -->
                                                <input asp-for="ConfirmPassword" type="password" class="form-control">

                                            </div>

                                            <!-- Submit -->
                                            <button type="button" onclick="main.doUpdatePassword('changepassword')"
                                                style="" id="btn-create" class="btn btn-primary lift">
                                                <div id="btn-loader" class=" d-none">
                                                    <div class="spinner-border mr-2" role="status"
                                                        style="width: 1.4rem;height: 1.4rem;">
                                                        <span class="sr-only">Loading...</span>
                                                    </div> Loading...
                                                </div>
                                                <span id="btn-text"> <i class="fas fa-key"></i> Update password</span>
                                            </button>

                                        </div>
                                    </div> <!-- / .row -->
                                </form>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>

            </div>

            <?php include '../includes/footer.php'; ?>

        </div>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../includes/logout.php'; ?>

    <?php include '../includes/loadscripts.php'; ?>
</body>

</html>