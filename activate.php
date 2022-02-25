<?php
    session_start();
    require_once('system/models/userSharedComponents.php');
    require_once('system/models/userProductModel.php');
    require_once('system/models/Cart.php');
    require_once('system/models/userAccountModel.php');
    require_once('system/database/conn.php');
    include 'includes/header.php';
    include 'includes/navbar.php';

	// if(!isset($_SESSION['user']))
	// {
	// 	echo("<script>location.href = 'index.php';</script>");
	// }
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
                                    <li class="breadcrumb-item active" aria-current="page">Activate Account Page</li>
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
                    <div class="">

                        <!-- Register Content Start -->
                        <div class="col">
							<h4 class="mb-3 text-center">Activate Account</h4>
                            <div class="login-reg-form-wrap sign-up-form">    
                                <!-- Main content -->
								<section class="">
									<div class="container">
										<div class="col">
											<?php
												$usersModel = new Users();

												$output = '';

												if(!isset($_GET['code']) OR !isset($_GET['user']))
												{
													echo $output = '
														<div class="alert alert-danger">
															<h4><i class="icon fa fa-warning"></i> Error!</h4>
															Code to activate account not found.
														</div>
														<p>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</p>
													';
												}
												else
												{
													$userdata = $usersModel->activateUser($_GET['code'], $sharedmodel->protect($_GET['user']));
                
													if (isset($userdata))
													{
														echo $userdata;
													}
													else
													{

													}
												}
											 ?>
										</div>
									</div>
								</section>
                            </div>
                        </div>
                        <!-- Register Content End -->
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