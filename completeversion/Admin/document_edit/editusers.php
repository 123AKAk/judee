<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    include '../system/custom_model/SponsorshipModel.php';

    $sharedComponentsModel = new SharedComponents();
    $model = new Sponsorship();
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sponsorship Program
                        </h1>
                        <a href="../document_view/sponsors.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> View All</a>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-sm-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h3 class="h5 text-gray-900 mb-4 text-uppercase" style="font-weight: 800;">Edit Sponsorship</h3>
                                </div>
                                <div class="text-center">
                                </div>
                                <?php
                                if (isset($_GET['id'])) 
                                {

                                    $sponsorship = $model->getSponsorshipById($_GET['id']);

                                    if (isset($sponsorship))
                                    {
                                        $idds = $sponsorship->EncryptedId;
                                        $fullname = $sponsorship->FullName;
                                        $dob = $sponsorship->Dob;
                                        $gender = $sponsorship->Gender;
                                        $shortrequest = $sponsorship->ShortRequest;
                                        $duration = $sponsorship->Duration;
                                        $price = $sponsorship->Price;
                                        $reasonforsponsorship = $sponsorship->ReasonForSponsorship;
                                        $nationality = $sponsorship->Nationality;
                                        $location = $sponsorship->Location;
                                        $bio = $sponsorship->Bio;
                                        $schoolgrade = $sponsorship->SchoolGrade;
                                        $hobbies = $sponsorship->Hobbies;
                                        $image = $sponsorship->Image;
                                ?>
                                <form enctype="multipart/form-data" action="../system/controller/request_handler_post.php" class="user" data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete2" data-ajax-begin="main.AjaxOnBegin2" data-ajax-success="main.AjaxOnSettingUpdate" data-ajax-failure="main.AjaxOnfailure" id="editSponsorship">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="text-center mb-3">
                                                <img src="<?php echo (!empty($image)) ? '../../uploads/'.$image : '../img/default.png  '; ?>" id="picture"
                                                class="img-fluid img-thumbnail" style="height: 260px;background: transparent;border: none;" alt="...">
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <div class="d-block">
                                                    <input type="hidden" name="fimagefilename" value="<?php echo $image; ?>" id="fimagefilename"/>
                                                    <input name="aimage" id="aimage" onchange="main.readURL(this, 'picture', 'fimagefilename')" style="display: none;" type="file" />
                                                    <button type="button" onclick="main.BtnUploadImg('aimage')" class="btn btn-secondary"><i
                                                            class="mr-3 fas fa-upload"></i>Upload</button>
                                                    <button type="button" onclick="main.BtnRemoveImg('picture', 'aimage', 'fimagefilename')" class="btn btn-danger"><i class="mr-3 fas fa-times"></i>
                                                        remove</button>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="text" name="namespace" id="namespace" class="d-none" value="editSponsorship" hidden/>
                                        <input type="text" name="id" class="d-none" value="<?php echo $idds;?>" hidden/>

                                        <div class="col-md-8 mt-3">
                                            <div class="form-group">
                                                <label for="fullname" class="pl-2">Full Name</label>
                                                <input name="pid" type="hidden" value=" <?php echo $idds ?>" id="pid">
                                                <input value="<?php echo $fullname ?>" name="fullname" type="text" class="form-control form-control-user" id="fullname" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="dob" class="pl-2">Date of Birth</label>
                                                            <input value="<?php echo $dob ?>" name="dob" type="date" class="form-control form-control-user" id="dob"
                                                                placeholder="">
                                                            <small class="pl-2" style="font-weight: 700;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender" class="pl-2">Gender</label>
                                                            <select value="<?php echo $gender ?>" name="gender" type="text" class="form-control form-control-user" id="gender" placeholder="">
                                                                <option value="<?php echo $gender ?>">
                                                                    <?php echo $gender ?>
                                                                </option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                            <small class="pl-2" style="font-weight: 700;"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="shortrequest" class="pl-2">Short Request</label>
                                                <input value="<?php echo $shortrequest ?>" name="shortrequest" type="text" class="form-control form-control-user" id="shortrequest" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration" class="pl-2">Duration</label>
                                                <input value="<?php echo $duration ?>" name="duration" type="date" class="form-control form-control-user" id="duration" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="pl-2">Price</label>
                                                <input value="<?php echo $price ?>" name="price" type="text" class="form-control form-control-user" id="price" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reasonforsponsorship" class="pl-2">Reason for Sponsorship</label>
                                        <input value="<?php echo $reasonforsponsorship ?>" name="reasonforsponsorship" type="text" class="form-control form-control-user" id="reasonforsponsorship" placeholder="">
                                        <small class="pl-2" style="font-weight: 700;"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nationality" class="pl-2">Nationality</label>
                                                <input value="<?php echo $nationality ?>" name="nationality" type="text" class="form-control form-control-user" id="nationality" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="location" class="pl-2">Location</label>
                                                <input value="<?php echo $location ?>" name="location" type="text" class="form-control form-control-user" id="location" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio" class="pl-2">Bio</label>
                                        <input value="<?php echo $bio ?>" name="bio" type="text" class="form-control form-control-user" id="bio" placeholder="">
                                        <small class="pl-2" style="font-weight: 700;"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="schoolgrade" class="pl-2">School Grade</label>
                                                <input value="<?php echo $schoolgrade ?>" name="schoolgrade" type="text" class="form-control form-control-user" id="schoolgrade" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hobbies" class="pl-2">Hobbies</label>
                                                <input value="<?php echo $hobbies ?>" name="hobbies" type="text" class="form-control form-control-user" id="hobbies" placeholder="">
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="button" onclick="main.doCreateNewSponsorships('editSponsorship')" style="font-size: 1rem;text-transform: uppercase;font-weight: 600;" id="btn-create" class="btn btn-primary btn-user text-center">
                                       <div id="dbtn-loader" class=" d-none">
                                          <div class="spinner-border mr-2" role="status" style="width: 1.4rem;height: 1.4rem;">
                                            <span class="sr-only">Loading...</span>
                                          </div>  Loading...
                                       </div>
                                        <span id="dbtn-text"> <i class="fas fa-pen"></i> Edit</span> 
                                    </button>
                                </form>
                                <?php
                                }}
                                ?>
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
    <script>
        $(function () {
            var FileUpload1 = document.getElementById("pimage");
            var button = document.getElementById("uploadImg");
            button.onclick = function () {
                FileUpload1.click();
            };

            main.setInputFilter(document.getElementById("dprice"), function(value) {
        return /^-?\d*$/.test(value); });
        
            main.setInputFilter(document.getElementById("damountneeded"), function(value) {
        return /^-?\d*$/.test(value); });
        
        main.setInputFilter(document.getElementById("dstartingprice"), function(value) {
        return /^-?\d*$/.test(value); });

        });
    </script>
   
</body>

</html>