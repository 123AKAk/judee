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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <b>
                                            Product Search - 
                                        <?php
                                        if (isset($_GET['id'])) 
                                        {
                                            $categoryid = $sharedmodel->unprotect($_GET['id']);
                                            echo $catname = implode(" ",$sharedmodel->getCategoryName($categoryid));
                                        }
                                        ?>
                                        </b>
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
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        <?php
                                            $sharedmodel = new SharedComponents();
                                            $category = $sharedmodel->getCategory();

                                            if(isset($category))
                                            {
                                                foreach($category as $row)
                                                {
                                                    $categoryid = $sharedmodel->protect($row["id"]);
                                        ?>
                                            <li>
                                                <a href="category.php?id=<?php echo $categoryid ?>">
                                                    <?php echo $row["catname"] ?>
                                                    <span>
                                                        (<?php echo $sharedmodel->getItemCountByCategory($categoryid) ?>)
                                                    </span>
                                                </a>
                                            </li>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-banner">
                                <div class="img-container">
                                    <a href="index.php">
                                        <img src="assets/img/banner/sidebar-banner.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                        </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1">
                        <div class="shop-product-wrapper">
                            <div>
                                <!-- product single item start -->
                                <div class="row">

                                    <?php
                                    if (isset($_GET['id'])) 
                                    {
                                        $productsModel = new Products();

                                        $product = $productsModel->getProductsByCategory($_GET['id'], "SELECT * FROM products WHERE category_id=:category_id");

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
                                    <!-- product grid start -->
                                    <div class="col-md-4 product-item">
                                        <figure class="product-thumb">
                                            <a href="product.php?id=<?php echo $productid ?>">
                                                <img class="pri-img" src="<?php echo $FeaturedImage1 ?>" alt="<?php echo $name ?> Image1" width="200" height="300">
                                                <img class="sec-img" src="<?php echo $FeaturedImage2 ?>" alt="<?php echo $name ?> Image2" width="200" height="300">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                            </div>
                                            <div class="cart-hover">
                                                <button class="btn btn-cart" onclick="docart('<?php echo $productid; ?>', 'addCart')">add to cart</button>
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
                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                    ?>
                                    <div class="container mb-5">
                                        <p>Sorry invalid Product Category Link, Click <a href="index.php">here</a> to redirect to <a href="index.php">Home page</p>
                                    </div>
                                     <?php
                                        }
                                    ?>
                            </div>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <!-- <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                    <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                                </ul>
                            </div> -->
                            <!-- end pagination area -->
                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';
    ?>

</html>