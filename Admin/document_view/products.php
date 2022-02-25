<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/ProductModel.php';

    $sharedComponentsModel = new SharedComponents();
    $productsModel = new Products();

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../includes/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product Management
                            <small class="badge badge-secondary" style="font-size: 1rem;"> Total: 
                            <?php
                                $sharedmodel = new SharedComponents();
                                echo $sharedmodel->getItemCount("products");
                            ?>
                        </small>
                        </h1>
                        <a href="../document_creation/addproducts.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create New</a>
                       </div>
                       <div class="text-center">
                       
                        </div>
                 
                    <style>
                        .card {
                            border: none;
                            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
                            overflow: hidden;
                            border-radius: 20px;
                            min-height: 350px;
                            box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.2);
                        }
                        .card.card-has-bg {
                            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
                            background-size: 120%;
                            background-repeat: no-repeat;
                            background-position: center center;
                        }
                        .card.card-has-bg:before {
                            content: "";
                            position: absolute;
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0;
                            background: inherit;
                            -webkit-filter: grayscale(1);
                            -moz-filter: grayscale(100%);
                            -ms-filter: grayscale(100%);
                            -o-filter: grayscale(100%);
                            filter: grayscale(100%);
                        }
                        .card.card-has-bg:hover {
                            transform: scale(0.98);
                            box-shadow: 0 0 5px -2px rgba(0, 0, 0, 0.3);
                            background-size: 130%;
                            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
                        }
                        .card.card-has-bg:hover .card-img-overlay {
                            transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
                            background: #234f6d;
                            background: linear-gradient(0deg, rgba(4, 69, 114, 0.5) 0%, #044572 100%);
                        }
                        .card .card-footer {
                            background: none;
                            border-top: none;
                        }
                        .card .card-footer .media img {
                            border: solid 3px rgba(234, 95, 0, 0.3);
                        }
                        .card .card-meta {
                            color: orange;
                        }

                        .card .card-body {
                            transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
                        }
                        .card:hover {
                            cursor: pointer;
                            transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
                        }
                        .card:hover .card-body {
                            margin-top: 30px;
                            transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
                        }
                        .card .card-img-overlay {
                            transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
                            background: #234f6d;
                            background: linear-gradient(0deg, rgba(35, 79, 109, 0.3785889356) 0%, #455f71 100%);
                        }
                    </style>

                <div class="row pb-5 mb-4">
                    <?php

                    $product = $sharedmodel->getData("SELECT * FROM products ORDER BY id DESC");
                    
                    if (!empty($product))
                    {
                        foreach($product as $item)
                        {
                            $productid = $sharedmodel->protect($item["id"]);
                            $category_id = $item["category_id"];
                            $name = $item["name"];
                            $datecreated = $item["date_added"];
                            $categoryid = $item["category_id"];
                            $price = $item["price"];
                            $image = $item["photo1"];

                            $FeaturedImage = (!empty($image)) ? '../../uploads/'.$image : '../../img/default.png';

                            $datecreated = new DateTime($datecreated);
                            $date = $datecreated->format('d')." ".$datecreated->format('M')."' ". $datecreated->format('y');
                    ?>
                            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 mt-4">
                                <div class="card text-white card-has-bg click-col" style="background-size:cover;background-image: url('<?php echo $FeaturedImage ?>');">
                                    <div class="card-img-overlay d-flex flex-column">
                                        <div class="badge project-badge" style="position: absolute;right: 10px;top: 10px;">
                                            <a href="../document_edit/editproducts.php?id=<?php echo $productid ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" onclick="main.doDeleteProduct('<?php echo $productid ?>', <?php echo $categoryid ?>)" title="Delete"><i class="fas fa-trash"></i></a>
                                        </div>
                                        <div class="card-body" style="padding-top: 2rem;">
                                            <div class="card-meta mb-2 small text-truncate"><?php echo implode(" ",$result = $sharedComponentsModel->getCategoryName($category_id));?></div>
                                            <h4 class="card-title mt-0" style="height: 88px; overflow: hidden;"><a class="text-white lines-3" href="../document_edit/editproducts.php?id=<?php echo $productid ?>"> <?php echo $name ?> </a></h4>
                                            <small><i class="far fa-clock"></i> <?php echo $date ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            }
                        }
                        else
                        {
                        ?>
                        <div class="col-12">
                            <div class="">
                                <div class="card-header" style="border:none">
                                    <div class="row align-items-center" style="text-align:center;">
                                        <div class="col">
                                            <!-- Title -->
                                            <br>
                                            <br>
                                            <br>
                                            <h4 class="card-header-title text-muted">
                                                Ooops! sorry no record at the moment
                                            </h4>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                
                </div>
                   
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../includes/footer.php'; ?>
            <?php
                $sidebaractive = "$('#navlink_Project').addClass('active')";
            ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../includes/logout.php'; ?>

    <?php include '../includes/loadscripts.php'; ?>       
</body>

</html>