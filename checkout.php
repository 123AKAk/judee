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
                                    <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <?php
                        if(!isset($_SESSION['user']))
                        {
                    ?>
                        <!-- Checkout Login Start -->
                        <div class="checkoutaccordion" id="checkOutAccordion">
                            <div class="card">
                                <h6>Returning Customer? <span data-bs-toggle="collapse" data-bs-target="#logInaccordion">Click
                                            Here To Login</span></h6>
                                <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <p>If you have shopped with us before, please enter your details in the boxes
                                            below. If you are a new customer, please create an Account and return back here.</p>
                                        <div class="login-reg-form-wrap mt-20">
                                            <div class="row">
                                                <div class="col-lg-7 m-auto">
                                                    <form action="#" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input id="loginemail" type="email" placeholder="Enter your Email" required />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input id="loginpassword" type="password" placeholder="Enter your Password" required />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                                <a href="password_forgot.php" class="forget-pwd">Forget Password?</a>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <button type="button" onclick="loginUser('checkout')" class="btn btn-sqr">Login</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Checkout Login Coupon Accordion End -->
                        <?php
                        }
                        else
                        {

                        }
                    ?>
                    </div>
                </div>
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">
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
                                    <input type="text" name="id" class="d-none" value="<?php echo (!empty($_SESSION['user'])) ? $userid : 0; ?>" hidden/>

                                    <div class="single-input-item">
                                        <label for="fullname" class="required">User Name</label>
                                        <input type="text" name="fullname" id="fullname" value="<?php echo (!empty($_SESSION['user'])) ? $username : ""; ?>" placeholder="Full Name" required />
                                    </div>

                                     <div class="single-input-item">
                                        <label for="email" class="required">Email Address</label>
                                        <input type="email" name="email" id="email" value="<?php echo (!empty($_SESSION['user'])) ? $email : ""; ?>" placeholder="Email Address" required />
                                    </div>

                                    <?php 
                                        if(!isset($_SESSION['user']))
                                        {
                                    ?>
                                    <div class="single-input-item">
                                        <label for="password" class="required">Password</label>
                                        <input type="password" name="password" id="apassword" placeholder="Password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="password" class="required">Confrim Password</label>
                                        <input type="password" id="aconfrimpassword" placeholder="Repeat Password" required />
                                    </div>
                                    <?php 
                                        }
                                    ?>

                                    <div class="single-input-item">
                                        <label for="address" class="required">Street address</label>
                                        <input type="text" name="address" id="address" value="<?php echo (!empty($_SESSION['user'])) ? $address : ""; ?>" placeholder="Street address" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="town_city" class="required">Town / City</label>
                                        <input type="text" name="town_city" id="town_city" value="<?php echo (!empty($_SESSION['user'])) ? $town_city : ""; ?>" placeholder="Town / City" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="country" class="required">Country</label>
                                        <input type="text" name="country" id="country" value="<?php echo (!empty($_SESSION['user'])) ? $country : ""; ?>" placeholder="Country" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="zipcode" class="required">Postcode / ZIP</label>
                                        <input type="text" name="zipcode" id="zipcode" value="<?php echo (!empty($_SESSION['user'])) ? $zipcode : ""; ?>" placeholder="Postcode / ZIP" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="contact_info">Phone</label>
                                        <input type="text" name="contact_info" id="contact_info" value="<?php echo (!empty($_SESSION['user'])) ? $contact_info : ""; ?>" placeholder="Mobile Number" />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ordernote">Order Note</label>
                                        <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo (!empty($_SESSION['user'])) ? $orderNote : ""; ?></textarea>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content" id="ordersummary">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <?php
                                        if(isset($_SESSION["cart_item"]))
                                        {
                                            $total_quantity = 0;
                                            $total_price = 0;
                                    ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach ($_SESSION["cart_item"] as $item)
                                            {
                                                $productsModel = new Products();

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
                                            ?>
                                            <tr>
                                                <td><a href="product-details.php"><?php echo $name; ?><strong> × <?php echo $item["quantity"] ?></strong></a>
                                                </td>
                                                <td><?php echo "$ ". number_format($item_price,2); ?></td>
                                            </tr>
                                            <?php
                                                    $total_quantity += $item["quantity"];
                                                    $total_price += ($price*$item["quantity"]);
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>
                                                    <strong>
                                                        <?php echo "$ ".number_format($total_price, 2); ?>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td>
                                                    <strong>
                                                    <?php echo "$ ".number_format($total_price, 2); ?>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php
                                        } 
                                        else 
                                        {
                                    ?>
                                        <div class="text-center"><h3>Your Cart is Empty</h3></div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="acceptterms" required/>
                                            <label class="custom-control-label" for="acceptterms">I have read and agree to
                                                the website <a href="privacypolicy.php">privacy and policy.</a></label>
                                        </div>
                                        
                                        <?php 
                                            if(!isset($_SESSION['user']))
                                            {
                                        ?>
                                            <button onclick="addbillingdetails('billingdetails')" class="btn btn-sqr">Place Order</button>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                            <button onclick="updatebillingdetails('billingdetails')" class="btn btn-sqr">Place Order</button>
                                            <!-- <div id="paypal-button-container"></div> -->
                                            <div id="paypal-payment-button"></div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>

    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AYEQPezUnDYm8QqAR5ZREWtQFekfK8DgpniGSc5wt7fo-99zPR9YiHipmhmsbnr4hIYA3pl0SqeVF9JR&currency=USD"></script> -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYEQPezUnDYm8QqAR5ZREWtQFekfK8DgpniGSc5wt7fo-99zPR9YiHipmhmsbnr4hIYA3pl0SqeVF9JR&disable-funding=credit,card"></script>
<script>
    paypal.Buttons({
        style : {
            color: 'blue',
            shape: 'pill'
        },
        createOrder: function (data, actions) 
        {
            return actions.order.create({
                purchase_units : [{
                    amount: {
                        value: '0.1'
                    }
                }]
            });
        },
        onApprove: function (data, actions) 
        {
            return actions.order.capture().then(function (details) 
            {
                console.log(details)
                //window.location.replace("http://localhost:63342/tutorial/paypal/success.php")
            })
        },
        onCancel: function (data) 
        {
            //window.location.replace("http://localhost:63342/tutorial/paypal/Oncancel.php")
        }
    }).render('#paypal-payment-button');
</script>
    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>
</html>