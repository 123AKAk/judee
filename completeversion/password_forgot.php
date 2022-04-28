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
                        <div class="col-lg-6">
                            <h5 class="mb-2 text-center">Forgot Password?</h5>
                            <p id="displaymsg" class="text-center" style="color:green; font-size:18px; font-weight:bold;"></p>
                              <div class="login-reg-form-wrap">
                                  <div class="container">
                                      <form>
                                        <div class="form-group has-feedback">
                                          <input type="email" id="resetloginemail" class="form-control" placeholder="Email" required>
                                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        </div>                                        
                                        <div class="col-xs-4">
                                            <button onclick="userResetPassword()" type="button" class="btn btn-block btn-flat">
                                              <i class="fa fa-mail-forward"></i> Send
                                            </button>
                                        </div>
                                      </form>
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