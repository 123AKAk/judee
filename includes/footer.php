
    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End --> 

    <!-- offcanvas mini cart start -->
    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="minicart-content-box" id="topcartdiv">
                <?php
                    if(isset($_SESSION["cart_item"]))
                    {
                        $total_quantity = 0;
                        $total_price = 0;
                ?>
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
                    <div class="minicart-item-wrapper">
                        <ul>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.php">
                                    <img class="img-fluid" src="<?php echo $productimage1; ?>" alt="Annibel Product" />
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product.php?id=<?php echo $sharedmodel->protect($item["id"])?>"><?php echo $name; ?></a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity"><?php echo $item["quantity"] ?> <strong>&times;</strong></span>
                                        <span class="cart-price"><?php echo "$ ".$price; ?></span>
                                    </p>
                                </div>
                                <button class="minicart-remove" onclick="docart('<?php echo $sharedmodel->protect($item['id'])?>', 'deleteCart', 99)"><i class="pe-7s-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    <?php
                            $total_quantity += $item["quantity"];
                            $total_price += ($price*$item["quantity"]);

                            }
                            else
                            {
                                $cartModel = new Carting();
                                $cartModel->deleteCart($sharedmodel->protect($item["id"]));
                            }
                        }
                    ?>
                    <div class="minicart-pricing-box">
                        <ul>
                            <li class="total">
                                <span>total</span>
                                <span>
                                    <strong>
                                        <?php echo "$ ".number_format($total_price, 2); ?>
                                    </strong>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-button">
                        <a href="cart.php"><i class="fa fa-shopping-cart"></i> View Cart</a>
                        <?php
                            if($total_quantity != 0)
                            {
                        ?>
                        <a href="checkout.php"><i class="fa fa-share"></i> Checkout</a>
                        <?php
                            }
                        ?>
                        <a href="javascript:void(0)" onclick="docart(0, 'emptyCart', 99)">Empty Cart</a>
                    </div>
                <?php
                    } 
                    else 
                    {
                ?>
                    <div class="text-center"><h4>Your Cart is Empty</h4></div>
                    <div class="minicart-button mt-5">
                        <a href="cart.php"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    </div>
                <?php 
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas mini cart end -->


 <!-- footer area start -->
 <footer class="footer-widget-area">
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <div class="widget-title">
                                <div class="widget-logo">
                                    <a href="index.php">
                                        <!-- <img src="assets/img/logo/logo.png" alt="brand logo"> -->
                                        <h5>Annibel Jewelry & Collections</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="widget-body">
                                <p>Annibel Jewelry pieces are exclusive, handcrafted and elegant.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Contact Us</h6>
                            <div class="widget-body">
                                <address class="contact-block">
                                    <ul>
                                        <li><i class="pe-7s-home"></i>6818 Storch Ct, Lanham MD 20706</li>
                                        <li><i class="pe-7s-mail"></i> <a href="mailto:annibel020@gmail.com">annibel020@gmail.com </a></li>
                                        <li><i class="pe-7s-call"></i> <a href="tel:+1-240-825-8086">+1-240-825-8086</a></li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Information</h6>
                            <div class="widget-body">
                                <ul class="info-list">
                                    <li><a href="#">about us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">private policy</a></li>
                                    <li><a href="#">contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Follow Us</h6>
                            <div class="widget-body social-link">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-20">
                    <div class="col-md-6">
                        <div class="newsletter-wrapper">
                            <h6 class="widget-title-text">Signup for newsletter</h6>
                            <form class="newsletter-inner" id="mc-form">
                                <input type="email" class="news-field" id="mc-email" autocomplete="off" placeholder="Enter your email address">
                                <button class="news-btn" id="mc-submit">Subscribe</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-payment">
                            <img src="assets/img/payment.png" alt="payment method">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright-text text-center">
                            <p>&copy; 2022 <b>Annibel Jewelry & Collections</b> Made with <i class="fa fa-heart text-danger"></i> by <a href="#"><b>RoiTech</b></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->