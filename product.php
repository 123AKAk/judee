<?php
    session_start();
    require_once('system/models/userSharedComponents.php');
    require_once('system/models/userProductModel.php');
    require_once('system/models/Cart.php');
    require_once('system/models/userAccountModel.php');
    require_once('system/database/conn.php');
    include 'includes/header.php';
    include 'includes/navbar.php';
 
    $sharedComponentsModel = new SharedComponents();
    $productsModel = new Products();
 ?>
 <style>
     p{
        overflow-wrap: break-word;
     }
 </style>
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php
                                            if (isset($_GET['id'])) 
                                            {
                                                $ProductData = $productsModel->getProductById($_GET['id']);
                
                                                if (isset($ProductData))
                                                {
                                                    echo $ProductData->Name;
                                                }
                                            }
                                            else
                                            {
                                                echo "Product-Details";
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding pb-0">
            <div class="container">
                <div class="row">
                    <!-- product details wrapper start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        
                        <?php
                            if (isset($_GET['id'])) 
                            {
                                $ProductData = $productsModel->getProductById($_GET['id']);

                                if (isset($ProductData))
                                {
                                    $productid = $ProductData->EncryptedId;
                                    $category = $ProductData->Category_Id;
                                    $name = $ProductData->Name;
                                    $description = $ProductData->Description;
                                    $slug = $ProductData->Slug;
                                    $price = $ProductData->Price;
                                    
                                    $FeaturedImage1 = (!empty($ProductData->Photo1)) ? 'uploads/'.$ProductData->Photo1 : 'uploads/'.$ProductData->Photo1.'';

                                    $FeaturedImage2 = (!empty($ProductData->Photo2)) ? 'uploads/'.$ProductData->Photo2 : 'uploads/'.$ProductData->Photo1.'';

                                    $FeaturedImage3 = (!empty($ProductData->Photo3)) ? 'uploads/'.$ProductData->Photo3 : 'uploads/'.$ProductData->Photo1.'';

                                    $FeaturedImage4 = (!empty($ProductData->Photo4)) ? 'uploads/'.$ProductData->Photo4 : 'uploads/'.$ProductData->Photo1.'';

                                    $catname = implode(" ",$result = $sharedComponentsModel->getCategoryName($category));
                            ?>
                        
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="product-large-slider">
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?php echo $FeaturedImage1 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?php echo $FeaturedImage2 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?php echo $FeaturedImage3 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?php echo $FeaturedImage4 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                    </div>
                                    <div class="pro-nav slick-row-10 slick-arrow-style">
                                        <div class="pro-nav-thumb">
                                            <img src="<?php echo $FeaturedImage1 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="<?php echo $FeaturedImage2 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="<?php echo $FeaturedImage3 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="<?php echo $FeaturedImage4 ?>" alt="Annibel Jewelry & Collections" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <div class="manufacturer-name">
                                            <a href="product.php?id=<?php echo $productid ?>"><?php echo $catname ?></a>
                                        </div>
                                        <h3 class="product-name"><?php echo $name ?></h3>
                                        <br>
                                        <div class="price-box"><b>Price:</b> 
                                            <span class="price-regular">$<?php echo $price ?></span>
                                        </div>
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">qty:</h6>
                                            <div class="quantity" id="reloaddiv">
                                                <div class="pro-qty">
                                                    <span class="dec qtybtn" onclick="docart('<?php echo $productid; ?>', 'updateCartMinus', '<?php echo $item['quantity'] ?>')">-</span>

                                                    <input id="quantityinput" type="text" value=" <?php 
                                                        if(isset($_SESSION["cart_item"]))
                                                        {
                                                            
                                                            $decryptedId = $sharedComponentsModel->unprotect($_GET['id']);

                                                            foreach($_SESSION["cart_item"] as $k => $v) 
                                                            {
                                                                if($decryptedId == $v["id"])
                                                                {
                                                                    echo $_SESSION["cart_item"][$k]["quantity"];
                                                                }
                                                                else
                                                                {
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    ?>" readonly>

                                                    <span class="inc qtybtn" onclick="docart('<?php echo $productid; ?>', 'updateCartAdd', '<?php echo $item['quantity'] ?>')">+</span>
                                                </div>
                                            </div>
                                            <div class="action_link">
                                                <a class="btn btn-cart2" href="javascript:void(0)" onclick="docart('<?php echo $productid; ?>', 'addCart', 99)">Add to cart</a>
                                            </div>
                                        </div>
                                        <div class="like-icon">
                                            <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                            <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                            <a class="pinterest" href="#"><i class="fa fa-instagram"></i>instagram</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details inner end -->

                        <!-- product details reviews start -->
                        <div class="product-details-reviews section-padding pb-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">
                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content reviews-tab">
                                            <div class="tab-pane fade show active" id="tab_one">
                                                <div class="tab-one">
                                                    <p><?php echo $description ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details reviews end -->
                        <?php
                                }
                            }
                            else
                            {
                        ?>
                        <div class="container">
                            <p>Sorry invalid Product Link, Click <a href="index.php">here</a> to redirect to <a href="index.php">Home page</p>
                        </div>
                            <?php
                            }
                        ?>
                    </div>
                    <!-- product details wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->

        <!-- related products area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Related products</h2>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="product-container">
                            <!-- product tab menu start -->
                            <div class="product-tab-menu">
                                <ul class="nav justify-content-center">
                                    <li><a href="#tab1" class="active" data-bs-toggle="tab">Best Offer</a></li>
                                </ul>
                            </div>
                            <!-- product tab menu end -->

                            <!-- product tab content start -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php
                                        $product = $sharedmodel->getData("SELECT * FROM products ORDER BY RAND() DESC");

                                        if (!empty($product))
                                        {
                                            foreach($product as $item)
                                            {
                                                if (isset($_GET['id'])) 
                                                {
                                                    if($item["id"] == $_GET['id']){}
                                                }
                                                $productid = $sharedmodel->protect($item["id"]);
                                                $name = $item["name"];
                                                $categoryida = $item["category_id"];
                                                $categoryid = $sharedmodel->protect($item["category_id"]);
                                                $price = $item["price"];
                                                $photo1 = $item["photo1"];
                                                $photo2 = $item["photo2"];

                                                $FeaturedImage1 = (!empty($photo1)) ? 'uploads/'.$photo1 : 'assets/img/default.png';
                                                $FeaturedImage2 = (!empty($photo2)) ? 'uploads/'.$photo2 : 'uploads/'.$photo1.'';

                                                $catname = implode(" ",$sharedmodel->getCategoryName($categoryida));
                                    ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="product.php?id=<?php echo $productid ?>">
                                                    <img class="pri-img" src="<?php echo $FeaturedImage1 ?>" alt="<?php echo $name ?> Image1" width="200" height="300">
                                                    <img class="sec-img" src="<?php echo $FeaturedImage2 ?>" alt="<?php echo $name ?> Image2" width="200" height="300">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    <!-- <div class="product-label discount">
                                                        <span>10%</span>
                                                    </div> -->
                                                </div>
                                                <div class="button-group">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View" onclick="main.LoadProductModal('<?php echo $productid; ?>')"><i class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart" onclick="docart('<?php echo $productid; ?>', 'addCart', 99)">add to cart</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="category.php?id=<?php echo $categoryid ?>"><?php echo $catname ?></a></p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="product.php?id=<?php echo $productid ?>"><?php echo $name ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular"><?php echo $price ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php
                                            }
                                        }
                                        else
                                        {
                                    ?>
                                    <div class="container">
                                        <h4>Sorry no Product Available</a></h4>
                                    </div>
                                     <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <!-- product tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- related products area end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>

</html>