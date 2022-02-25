<?php
    session_start();
    require_once('system/models/userSharedComponents.php');
    require_once('system/models/userProductModel.php');
    require_once('system/models/Cart.php');
    require_once('system/models/userAccountModel.php');
    require_once('system/database/conn.php');
    include 'includes/header.php';
    include 'includes/navbar.php';
 ?>
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <!-- Login Content Start -->
                        <div class="col">
                            <p id="displaymsg" class="text-center" style="color:green; font-size:18px; font-weight:bold;"></p>
                              <div class="login-reg-form-wrap">
                              <div class="container">
                                <?php
                                    $usersModel = new Users();

                                    $output = '';

                                    if(!isset($_GET['code']) OR !isset($_GET['user']))
                                    {
                                        echo $output = '
                                            <div class="alert alert-danger">
                                                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                                                Code to reset account password not found.
                                            </div>
                                            <p>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</p>
                                        ';
                                    }
                                    else
                                    {
                                        $userdata = $usersModel->checkactivateUser($_GET['code'], $sharedmodel->protect($_GET['user']));

                                        if (isset($userdata))
                                        {
                                            echo $userdata["message"];
                                            if($userdata["message"] == "Already Activated" || $userdata["message"] == "Account Activated")
                                            {
                                ?>
                                    <fieldset>
                                        <legend>Account Password change</legend>
                                        <input type="text" id="userid" name="id" class="d-none" value="<?php echo $sharedmodel->protect($_GET['user']); ?>" hidden/>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="new-pwd" class="required">New
                                                        Password</label>
                                                    <input type="password" id="apassword" placeholder="New Password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="confirm-pwd" class="required">Confirm
                                                        Password</label>
                                                    <input type="password" id="aconfrimpassword" placeholder="Confirm Password" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="single-input-item">
                                        <button type="button" onclick="changePassword()" class="btn btn-sqr">Save Changes</button>
                                    </div>
                                    <?php
                                            }
                                            else 
                                            {
                                    ?>
                                        <div class="alert alert-danger">
                                            <h4><i class="icon fa fa-warning"></i> Error!</h4>
                                            Cannot activate account. Wrong code.
                                        </div>
                                        <p>You may <a href="register.php">Signup</a> or back to <a href="index.php">Homepage</a>.</p>
                                    <?php
                                            }
                                    ?>
                                  <?php
                                        }
                                    }
                                    ?>
                                </div>
                              </div>
                        </div>
                        <!-- Login Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>

</html>