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
        <!-- hero slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home1-slide2.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h2 class="slide-title">Family Jewellery <span>Collection</span></h2>
                                        <h4 class="slide-desc">
                                        <?php
                                            $product = $sharedmodel->getData("SELECT * FROM products ORDER BY RAND() DESC LIMIT 1");
                                            if (!empty($product))
                                            {
                                                foreach($product as $item)
                                                {
                                                    $slug = $item["slug"];
                                                    echo (!empty($slug)) ? $slug : 'Your Fashion Destination';
                                                }
                                            }
                                        ?>
                                        </h4>
                                        <a href="javascript:void(0)" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home1-slide3.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-2 float-md-end float-none">
                                        <h2 class="slide-title">Natural Gemstones<span>Collection</span></h2>
                                        <h4 class="slide-desc">
                                        <?php
                                            $product = $sharedmodel->getData("SELECT * FROM products ORDER BY RAND() DESC LIMIT 1");
                                            if (!empty($product))
                                            {
                                                foreach($product as $item)
                                                {
                                                    $slug = $item["slug"];
                                                    echo (!empty($slug)) ? $slug : 'Bold aesthetics and the cultural heritage of Africa';
                                                }
                                            }
                                        ?>
                                        </h4>
                                        <a href="javascript:void(0)" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home1-slide1.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-3">
                                        <h2 class="slide-title">Best Designer<span>Jewellery</span></h2>
                                        <h4 class="slide-desc">
                                        <?php
                                            $product = $sharedmodel->getData("SELECT * FROM products ORDER BY RAND() DESC LIMIT 1");
                                            if (!empty($product))
                                            {
                                                foreach($product as $item)
                                                {
                                                    $slug = $item["slug"];
                                                    echo (!empty($slug)) ? $slug : 'Inspired by a love of natural gemstones and a vacuum in the jewelry market for quality styles';
                                                }
                                            }
                                        ?>
                                        </h4>
                                        <a href="shop.php" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item end -->

            </div>
        </section>
        <!-- hero slider area end -->
      

        <!-- twitter feed area start -->
        <div class="twitter-feed">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="twitter-feed-content text-center">
                            <p>
                                “I’ve always had a love of natural gemstones, and noticed a white space in the jewelry market for quality styles and stones at an affordable price. So, I decided to create them myself.”
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- twitter feed area end -->

        <!-- service policy area start -->
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Free Shipping</h6>
                                <p>Free shipping (Depends on the Order)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Support 24/7</h6>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Money Return</h6>
                                <p>30 days for free return (Depends on the Order)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>100% Payment Secure</h6>
                                <p>We ensure secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                <?php
                    $productsModel = new Products();
                    //$sharedmodel = new SharedComponents();

                    $product = $sharedmodel->getData("SELECT * FROM category ORDER BY RAND() LIMIT 4");

                    //$product_cat = $sharedmodel->getData("SELECT * FROM products ORDER BY id");

                    if (!empty($product))
                    {
                        $num = 0;
                        foreach($product as $item)
                        {
                            $num++;

                            $categoryid = $sharedmodel->protect($item["id"]);
                            $photo1 = "assets/img/banner/img".$num."-top.jpg";

                            $FeaturedImage1 = (!empty($photo1)) ? ''.$photo1 : 'assets/img/default.png';

                            $catname = implode(" ",$sharedmodel->getCategoryName($item["id"]));

                            //echo $num;
                ?>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a>
                                <img src="<?php echo $FeaturedImage1 ?>" alt="<?php echo $catname ?> CategoryImage1">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1">Annibel </h5>
                                <h2 class="banner-text2"><?php echo $catname ?> </h2>
                                <a class="btn btn-text" href="category.php?id=<?php echo $categoryid ?>">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                <?php
                        }
                    }
                    else
                    {
                ?>
                <div class="container">
                    <!-- <h4>Sorry not Product Available</h4> -->
                </div>
                    <?php
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- banner statistics area end -->

        <!-- product area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">our products</h2>
                            <p class="sub-title">Add our products to weekly lineup</p>
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
                                        $product = $sharedmodel->getData("SELECT * FROM products ORDER BY id DESC");

                                        if (!empty($product))
                                        {
                                            foreach($product as $item)
                                            {
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
                                                    <span class="price-regular">$<?php echo $price ?></span>
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
                                        <h4>Sorry no Product Available</h4>
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
        <!-- product area end -->


        <section class="feature-product section-padding">
            <?php
                if($sharedmodel->getItemCount("products") > 5)
                {
            ?>
            <!-- product item list wrapper start -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Other products</h2>
                            <p class="sub-title">featured products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="shop-product-wrap grid-view row mbn-30">
                    <?php
                        $product = $sharedmodel->getData("SELECT * FROM products ORDER BY id ASC LIMIT 20");
                        if (!empty($product))
                        {
                            foreach($product as $item)
                            {
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
                    <!-- product single item start -->
                    <div class="col-md-3 col-sm-6">
                        <!-- product grid start -->
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
                                    <div class="product-label discount">
                                        <span>10%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search" onclick="main.LoadProductModal('<?php echo $productid; ?>')"></i></span></a>
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
                                    <span class="price-regular">$<?php echo $price ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- product grid end -->
                    </div>
                    <!-- product single item start -->
                    <?php
                            }
                        }
                        else
                        {
                    ?>
                    <div class="container">
                        <h4>Sorry not Product Available</h4>
                    </div>
                        <?php
                        }
                    ?>
                </div>
                <!-- product item list wrapper end -->
            </div>
            <?php
                }
                else
                {

                }
            ?>
        </section>
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>
    
</html>