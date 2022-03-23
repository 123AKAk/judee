<?php
    session_start();
    require_once('system/models/userSharedComponents.php');
    require_once('system/models/userProductModel.php');
    require_once('system/models/Cart.php');
    require_once('system/models/userAccountModel.php');
    require_once('system/database/conn.php');
    include 'includes/header.php';
    include 'includes/navbar.php';
 
    if(!isset($_SESSION['user']))
	{
		echo("<script>location.href = 'index.php';</script>");
	}
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
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Dashboard</a>
                                            <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                                Orders</a>
                                            <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                                Details</a>
                                            <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                                Payment
                                                Method</a>
                                            <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                    <!-- My Account Tab Menu End -->

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Dashboard</h5>
                                                    <div class="welcome">
                                                        <p>Hello, <strong><?php echo $statusername; ?></strong> (If Not <strong><?php echo $statusername; ?>
                                                            ! </strong><a href="logout.php" class="logout"> Please Logout</a>)</p>
                                                    </div>
                                                    <p class="mb-0">From your account dashboard. you can easily check &
                                                        view your recent orders, manage your shipping and billing addresses
                                                        and edit your password and account details.</p>
                                                    <p class="mb-0 mt-3">
                                                        If you want your account deleted, please request deletion by sending an email to <a href="mailto:support@annibeljewelry">support@annibeljewelry</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->

                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Pending Orders</h5>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Product Name</th>
                                                                    <th>Price</th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(isset($_SESSION["cart_item"]))
                                                            {

                                                                $productsModel = new Products();

                                                                $num = 0;
                                                                foreach ($_SESSION["cart_item"] as $item)
                                                                {
                                                                    $ProductData = $productsModel->getProductById($sharedmodel->protect($item["id"]));

                                                                    if (isset($ProductData))
                                                                    {
                                                                        $categoryid = $ProductData->Category_Id;
                                                                        $category = $ProductData->Category_Id;
                                                                        $name = $ProductData->Name;
                                                                        $description = $ProductData->Description;
                                                                        $slug = $ProductData->Slug;
                                                                        $price = $ProductData->Price;

                                                                        $productimage1 = (!empty($ProductData->Photo1)) ? 'uploads/'.$ProductData->Photo1 : 'assets/img/default.png';

                                                                        $catname = implode(" ",$result = $sharedmodel->getCategoryName($category));

                                                                        $item_price = $item["quantity"]*$price;
                                                                        
                                                                        $num++;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $num ?></td>
                                                                    <td>
                                                                        <a href="product.php?id=<?php echo $sharedmodel->protect($item["id"])?>" class="text-decoration:none;color:black;"><?php echo $name; ?></a>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo "$ ".$price; ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo "$ ". number_format($item_price,2); ?>
                                                                    </td>
                                                                    <td><a href="cart.php" class="btn btn-sqr">View</a>
                                                                    </td>
                                                                </tr>
                                                                <?php                     
                                                                    }
                                                                    else
                                                                    {
                                                                        $cartModel = new Carting();
                                                                        $cartModel->deleteCart($sharedmodel->protect($item["id"]));
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <p>No Current Pending Orders</p>
                                                                <?php                     
                                                            }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="myaccount-content">
                                                    <h5>Placed Orders</h5>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Order</th>                      
                                                                    <th>Product Name</th>
                                                                    <th>Transaction Id</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
        <?php
            require_once 'Admin/system/custom_model/salesModel.php';
            $salesModel = new Sales();
            
            $SaleData = $salesModel->getSalesById($sharedmodel->protect($_SESSION['user']));
                
            if (isset($SaleData))
            {
                //sales
                $userid = $SaleData->userid;
                $saleamount = $SaleData->Amount;
                $transactionid = $SaleData->transactionid;
                $sales_date = $SaleData->Sales_Date;
                $sales_date = new DateTime($sales_date);
                $salesdate = $sales_date->format('d')." ".$sales_date->format('M')."' ". $sales_date->format('y');

                //cart
                $CartData = $sharedmodel->getCartByUserId($sharedmodel->protect($userid));

                if (!empty($CartData))
                {
                    $num = 0;
                    foreach($CartData as $item)
                    {
                        $productid = $sharedmodel->protect($item["productid"]);
                        $quantity = $item["quantity"];

                        //product
                        $productsModel = new Products();
                        $ProductData = $productsModel->getProductById($productid);
                        
                        $pid = $ProductData->EncryptedId;
                        $category = $ProductData->Category_Id;
                        $name = $ProductData->Name;
                        $price = $ProductData->Price;

                        $num++;
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <td>
                <a href="product.php?id=<?php echo $productid ?>"><?php echo $name ?></a>
            </td>
            <td><?php echo $transactionid ?></td>
            <td><?php echo $price ?></td>
            <td><?php echo $quantity ?></td>
            <td><?php echo $salesdate ?></td>
            <td>
                <a class="btn btn-sqr">
                    Cancel
                </a>
            </td>
        </tr>
        </tbody>
        <?php
                    }
                }
            }
            else
            {
        ?>
        <div class="containerp-fluid">
            <div class="">
                <div class="card-header" style="border:none">
                    <div class="row align-items-center" style="text-align:center;">
                        <div class="col">
                            <!-- Title -->
                            <h6 class="card-header-title text-muted m-4">
                                Ooops! sorry no record at the moment
                            </h6>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
        <?php
            }
        ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->

                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Payment Method</h5>
                                                    <p class="saved-message">You Can't Save Your Payment Method yet.</p>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->

                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Account Details</h5>
                                                    <div class="account-details-form">
                                                        <?php
                                                            if(isset($_SESSION['user']))
                                                            {
                                                                require_once('system/models/userAccountModel.php');
                                                                $userModel = new Users();
                                                                $UserData = $userModel->getUserById($sharedmodel->protect($_SESSION['user']));

                                                                if (isset($UserData))
                                                                {
                                                                    $userid = $UserData->EncryptedId;
                                                                    $username = $UserData->Fullname;
                                                                    $email = $UserData->Email;
                                                                    $password = $UserData->Password;
                                                                    $address = $UserData->Address;
                                                                    $town_city = $UserData->Town_City;
                                                                    $country = $UserData->Country;
                                                                    $zipcode = $UserData->ZipCode;
                                                                    $contact_info = $UserData->Contact_Info;
                                                                    $orderNote = $UserData->OrderNote;
                                                                }
                                                            }
                                                        ?>
                                                        <form enctype="multipart/form-data" action="system/controller/userRequest_handler_get.php" class="user" data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete2" data-ajax-begin="main.AjaxOnBegin2" data-ajax-success="<?php echo (!empty($_SESSION['user'])) ? "main.AjaxOnAddingSucess" : "main.AjaxOnAddingSucess2"; ?>" data-ajax-failure="main.AjaxOnfailure" id="billingdetails">

                                                        <input type="text" name="namespace" id="namespace" class="d-none" value="<?php echo (!empty($_SESSION['user'])) ? "updatebillingdetails" : "addbillingdetails"; ?>" hidden/>
                                                        <input type="text" id="userid" name="id" class="d-none" value="<?php echo (!empty($_SESSION['user'])) ? $userid : 0; ?>" hidden/>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">User
                                                                            Name</label>
                                                                        <input type="text" name="fullname" id="fullname" value="<?php echo $username; ?>" placeholder="Full Name" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Email
                                                                            Name</label>
                                                                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email Address" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="address" class="required">Street address</label>
                                                                <input type="text" name="address" id="address" value="<?php echo $address; ?>" placeholder="Street address" required />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="town_city" class="required">Town / City</label>
                                                                        <input type="text" name="town_city" id="town_city" value="<?php echo $town_city; ?>" placeholder="Town / City" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="country" class="required">Country</label>
                                                                        <input type="text" name="country" id="country" value="<?php echo $country; ?>" placeholder="Country" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="zipcode" class="required">Postcode / ZIP</label>
                                                                        <input type="text" name="zipcode" id="zipcode" value="<?php echo $zipcode; ?>" placeholder="Postcode / ZIP" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="contact_info">Phone</label>
                                                                        <input type="text" name="contact_info" id="contact_info" value="<?php echo $contact_info; ?>" placeholder="Mobile Number" />
                                                                    </div>
                                                                </div>
                                                                <div class="single-input-item d-none" style="display:hidde;">
                                                                    <label for="ordernote">Order Note</label>
                                                                    <textarea name="ordernote" id="ordernote" hidden cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo (!empty($_SESSION['user'])) ? $orderNote : ""; ?></textarea>
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <div class="custom-control custom-checkbox mb-20">
                                                                        <input checked type="checkbox" class="custom-control-input" id="acceptterms" required/>
                                                                        <label class="custom-control-label" for="acceptterms">I have read and agree to
                                                                            the website <a href="privacypolicy.php">privacy and policy.</a></label>
                                                                    </div>
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <button type="button" onclick="updatebillingdetails('billingdetails')" class="btn btn-sqr">Save Changes</button>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <fieldset>
                                                                <legend>Account Password change</legend>
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->
                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>

</html>