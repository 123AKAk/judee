<?php 
    include '../includes/session.php';
    include '../includes/header.php';
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
                <?php include '../includes/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between ">
                        <h1 class="h3 mb-0 text-gray-800">
                        </h1>
                        <a href="../document_view/users.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> View All</a>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-sm-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h3 class="h5 text-gray-900 mb-4 text-uppercase" style="font-weight: 800;">Add User</h3>
                                </div>
                                <div class="text-center">
                                </div>
                                <form enctype="multipart/form-data" action="../system/controller/request_handler_post.php" class="user" data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete2" data-ajax-begin="main.AjaxOnBegin2" data-ajax-success="main.AjaxOnAddingSucess" data-ajax-failure="main.AjaxOnfailure" id="createSponsorship">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="text-center mb-3">
                                                <img src="../img/default.png" id="picture"
                                                class="img-fluid img-thumbnail" style="height: 260px;background: transparent;border: none;" alt="...">
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <div class="d-block">
                                                    <input name="image" id="pimage" onchange="main.readURL(this, 'picture')" style="display: none;" type="file" />
                                                    <button type="button" onclick="main.BtnUploadImg('pimage')" class="btn btn-secondary"><i
                                                            class="mr-3 fas fa-upload"></i>Upload</button>
                                                    <button type="button" onclick="main.BtnRemoveImg('picture', 'pimage')" class="btn btn-danger"><i class="mr-3 fas fa-times"></i>
                                                        remove</button>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="text" name="namespace" id="namespace" class="d-none" value="createSponsorship" hidden/>
                                        <input type="text" name="id" class="d-none" value="" hidden/>

                                        <div class="col-md-8 mt-3">
                                            <div class="form-group">
                                                <label for="fullname" class="pl-2">Full Name</label>
                                                <input name="fullname" type="text" class="form-control form-control-user" id="fullname" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="dob" class="pl-2">Date of Birth</label>
                                                            <input name="dob" type="date" class="form-control form-control-user" id="dob"
                                                                placeholder="">
                                                            <small class="pl-2" style="font-weight: 700;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender" class="pl-2">Gender</label>
                                                            <select name="gender" type="text" class="form-control form-control-user" id="gender" placeholder="">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                            <small class="pl-2" style="font-weight: 700;"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="shortrequest" class="pl-2">Short Request</label>
                                                <input name="shortrequest" type="text" class="form-control form-control-user" id="shortrequest"placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration" class="pl-2">Duration</label>
                                                <input name="duration" type="date" class="form-control form-control-user" id="duration" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="pl-2">Price</label>
                                                <input name="price" type="text" class="form-control form-control-user" id="price" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reasonforsponsorship" class="pl-2">Reason for Sponsorship</label>
                                        <input name="reasonforsponsorship" type="text" class="form-control form-control-user" id="reasonforsponsorship" placeholder="">
                                        <small class="pl-2" style="font-weight: 700;"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nationality" class="pl-2">Nationality</label>
                                                <input name="nationality" type="text" class="form-control form-control-user" id="nationality" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="location" class="pl-2">Location</label>
                                                <input name="location" type="text" class="form-control form-control-user" id="location" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio" class="pl-2">Bio</label>
                                        <input name="bio" type="text" class="form-control form-control-user" id="bio" placeholder="">
                                        <small class="pl-2" style="font-weight: 700;"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="schoolgrade" class="pl-2">School Grade</label>
                                                <input name="schoolgrade" type="text" class="form-control form-control-user" id="schoolgrade" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hobbies" class="pl-2">Hobbies</label>
                                                <input name="hobbies" type="text" class="form-control form-control-user" id="hobbies" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="button" onclick="main.doCreateNewSponsorships('createSponsorship')" style="font-size: 1rem;text-transform: uppercase;font-weight: 600;" id="btn-create" class="btn btn-primary btn-user text-center">
                                       <div id="dbtn-loader" class=" d-none">
                                          <div class="spinner-border mr-2" role="status" style="width: 1.4rem;height: 1.4rem;">
                                            <span class="sr-only">Loading...</span>
                                          </div>  Loading...
                                       </div>
                                        <span id="dbtn-text"> <i class="fas fa-pen"></i> Create</span> 
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../includes/footer.php'; ?>
            <?php
                $sidebaractive = "$('#navlink_Sponsorship').addClass('active')";
            ?>
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