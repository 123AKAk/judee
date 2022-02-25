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
                                    <li class="breadcrumb-item active" aria-current="page">cart</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container" id="cartdiv">
                <?php
                    if(isset($_SESSION["cart_item"]))
                    {
                        $total_quantity = 0;
                        $total_price = 0;
                ?>
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            // if(isset($_SESSION["cart_item"]))
                                            // {
                                            //     $total_quantity = 0;
                                            //     $total_price = 0;
                                            //     foreach ($_SESSION["cart_item"] as $item)
                                            //     {
                                            //         echo $item["id"]." | "; 
                                            //         echo $item["quantity"]."<br>"; 
                                            //     }
                                            // }
                                            // else 
                                            // {
                                            //     echo "Nothing";
                                            // }

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
                                            <td class="pro-thumbnail">
                                                <a href="product.php?id=<?php echo $sharedmodel->protect($item["id"])?>" >
                                                    <img class="img-fluid" src="<?php echo $productimage1; ?>" alt="Annibel Product" />
                                                </a>
                                            </td>

                                            <td class="pro-title">
                                                <a href="product.php?id=<?php echo $sharedmodel->protect($item["id"])?>" ><?php echo $name; ?></a>
                                            </td>

                                            <td class="pro-price">
                                                <span><?php echo "$ ".$price; ?></span>
                                            </td>

                                            <td class="pro-quantity">
                                                <div class="pro-qty">
                                                    <span class="dec qtybtn" onclick="docart('<?php echo $sharedmodel->protect($item['id'])?>', 'updateCartMinus')">-</span>
                                                    <input id="quantityinput" type="text" value="<?php echo $item["quantity"] ?>" readonly>
                                                    <span class="inc qtybtn" onclick="docart('<?php echo $sharedmodel->protect($item['id'])?>', 'updateCartAdd')">+</span>
                                                </div>
                                            </td>

                                            <td class="pro-subtotal">
                                                <span><?php echo "$ ". number_format($item_price,2); ?>  <?php //echo $item["quantity"] ?> </span>
                                            </td>
                                            <td class="pro-remove">
                                                <a href="javascript:void(0)" onclick="docart('<?php echo $sharedmodel->protect($item['id'])?>', 'deleteCart')">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="cart-update">
                                    <a href="javascript:void(0)" class="btn btn-sqr" onclick="docart(0, 'emptyCart')">Empty Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Cart Totals</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>
                                                    <?php echo "$ ".number_format($total_price, 2); ?>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Shipping</td>
                                                <td>$70</td>
                                            </tr> -->
                                            <tr class="total">
                                                <td>Total Amount</td>
                                                <td class="total-amount">
                                                    <?php echo "$ ".number_format($total_price, 2); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="checkout.php" class="btn btn-sqr d-block">Proceed Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
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
        </div>
        <!-- cart main wrapper end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>

   </html>