<body>
    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top bdr-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Welcome to Annibel Jewelry & Collections</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                    <li class="curreny-wrap">
                                        $ Currency
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list curreny-list">
                                            <li><a href="#">$ USD</a></li>
                                        </ul>
                                    </li>
                                    <li class="language">
                                        <img src="assets/img/icon/en.png" alt="flag"> English
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#"><img src="assets/img/icon/en.png" alt="flag"> english</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="index.php">
                                    <!-- <img src="assets/img/logo/logo.png" alt="Brand Logo"> -->
                                    <h5>Annibel Jewelry & Collections</h5>
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <?php $sharedmodel = new SharedComponents(); ?>
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li>
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li>
                                                <a href="about-us.php">About us</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Category(<?php echo $sharedmodel->getItemCount("category"); ?>)<i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown">
                                                    <?php
                                                        $sharedmodel = new SharedComponents();
                                                        $category = $sharedmodel->getCategory();

                                                        if(isset($category))
                                                        {
                                                            foreach($category as $row)
                                                            {
                                                                $categoryid = $sharedmodel->protect($row["id"]);
                                                    ?>
                                                        <li><a href="category.php?id=<?php echo $categoryid ?>"><?php echo $row["catname"] ?></a></li>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="contact-us.php">Contact us</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block animated jackInTheBox" action="search.php" method="POST">
                                        <input type="text" name="prod" placeholder="Search entire store here" class="header-search-field">
                                        <button type="submit" class="header-search-btn"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <?php
                                            if(isset($_SESSION['user']))
                                            {
                                                $statusername = "";

                                                $userModel = new Users();
                                                $UserData = $userModel->getUserById($sharedmodel->protect($_SESSION['user']));

                                                if (isset($UserData))
                                                {
                                                    $stringout = $UserData->Fullname;
                                                    $stringout = strlen($UserData->Fullname) > 9 ? substr($UserData->Fullname,0,9)."..." : $UserData->Fullname;
                                                    $statusername = $UserData->Fullname;
                                        ?>
                                                <a class="aellipsis " href="account.php" style="text-decoration:none; color:black; font-weight:semi-bold;">
                                                    <?php echo  $stringout;?>
                                                </a>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <li class="user-hover">
                                            <a href="javascript:void(0)">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <li><a href="login.php">login</a></li>
                                                <li><a href="register.php">register</a></li>
                                                <li><a href="account.php">my account</a></li>
                                                <?php
                                                    if(isset($_SESSION['user']))
                                                    {
                                                ?>
                                                <li><a href="logout.php">log out</a></li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification" id="topcartcount">
                                                <?php
                                                    if(!empty($_SESSION["cart_item"]))
                                                    {
                                                        echo count($_SESSION["cart_item"]); 
                                                    }
                                                    else
                                                    {
                                                        echo 0;
                                                    }
                                                ?>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index.php">

                                    <!-- <img src="assets/img/logo/logo.png" alt="Brand Logo"> -->
                                    <h5>Annibel Jewelry & Collections</h5>
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart.php">
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification" id="topcartcount2">
                                            <?php
                                                if(!empty($_SESSION["cart_item"]))
                                                {
                                                    echo count($_SESSION["cart_item"]); 
                                                }
                                                else
                                                {
                                                    echo 0;
                                                }
                                            ?>
                                        </div>
                                    </a>
                                </div>
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form action="search.php" method="POST">
                            <input name="prod" type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">

                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about-us.php">About us</a></li>
                                <li class="menu-item-has-children"><a href="category.php">Category(<?php echo $sharedmodel->getItemCount("category"); ?>)</a>
                                    <ul class="dropdown">
                                        <?php
                                            
                                            $category = $sharedmodel->getCategory();
                                            
                                            if(isset($category))
                                            {
                                                foreach($category as $row)
                                                {
                                                    $categoryid = $sharedmodel->protect($row["id"]);
                                        ?>
                                            <li><a href="category.php?id=<?php echo $categoryid ?>"><?php echo $row["catname"] ?></a></li>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="contact-us.php">Contact us</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                    <div class="mobile-settings">
                        <ul class="nav">
                            <li>
                                <?php
                                    require_once('system/models/userAccountModel.php');
                                    if(isset($_SESSION['user']))
                                    {
                                        $userModel = new Users();
                                        $UserData = $userModel->getUserById($sharedmodel->protect($_SESSION['user']));

                                        if (isset($UserData))
                                        {
                                            $stringout = strlen($UserData->Fullname) > 10 ? substr($UserData->Fullname,0,20)."..." : $UserData->Fullname;
                                ?>
                                        <a class="aellipsis " href="account.php" style="text-decoration:none; color:black; font-weight:semi-bold;">
                                            <?php echo  $stringout;?>
                                        </a>
                                <?php
                                        }
                                    }
                                ?>
                            </li>
                            <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="myaccount">
                                        <?php
                                            if(isset($_SESSION['user']))
                                            {
                                        ?>
                                        <a class="dropdown-item" href="logout.php">Log Out</a>
                                        <?php
                                            }
                                        ?>
                                        <a class="dropdown-item" href="account.php">My account</a>
                                        <a class="dropdown-item" href="login.php"> Login</a>
                                        <a class="dropdown-item" href="register.php">Register</a>
                                    </div>
                                </div>
                            </li>
                            <!-- <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="currency" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Currency
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="currency">
                                        <a class="dropdown-item" href="#">$ USD</a>
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>

                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a href="tel:+1-240-825-8086">+1-240-825-8086</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a href="mailto:annibel020@gmail.com">annibel020@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>
    <!-- end Header Area -->

