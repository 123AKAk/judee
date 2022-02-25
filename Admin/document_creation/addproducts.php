<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';

    require_once '../system/custom_model/ProductModel.php';
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include ('../includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include ('../includes/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">

                     <!-- Page Heading -->
                    
                    <div class="justify-content-center tab-pane fade show active    mt-1">
                        <div class="col">

                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="h4 mb-0 text-gray-800">Add Products
                            </h3>
                            <a href="../document_view/products.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All</a>
                        </div>

                        
                        <!-- Form -->
                        <div class="tab-pane fade show active mt-5" id="lcp-body-tab1" role="tabpanel" aria-labelledby="lcp-nav-tab1">
                                <form enctype="multipart/form-data" action="../system/controller/request_handler_post.php" class="user" data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete2" data-ajax-begin="main.AjaxOnBegin2" data-ajax-success="main.AjaxOnAddingSucess" data-ajax-failure="main.AjaxOnfailure" id="addProduct">
                                    <div class="text-center">
                                    </div>

                                    <input type="text" name="namespace" id="namespace" class="d-none" value="addProduct" hidden/>
                                    <input type="text" name="id" class="d-none" hidden/>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input id="name" name="name" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="category" class="pl-2">Product Category</label>
                                                <input name="productcategory" type="text" class="form-control" id="category" list="productcategory" placeholder="">
                                                <datalist id="productcategory">
                                                <?php
                                                    $sharedmodel = new SharedComponents();
                                                    $category = $sharedmodel->getCategory();

                                                    if(isset($category))
                                                    {
                                                        foreach($category as $row)
                                                        {
                                                ?>
                                                    <option value="<?php echo $row["catname"]; ?>">
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                </datalist>
                                                <small class="pl-2" style="font-weight: 700;"></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-1">Description</label>
                                                <input id="description" name="description" type="text" class="d-none" hidden>
                                                <div id="loadQuill" style="height:150px;background:white"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <small class="form-text text-muted">
                                                    This will show on the site URL when the product page is Opened, Slug should be almost or simliar to product name.
                                                </small>
                                                <input id="slug" name="slug" type="text" class="form-control mb-3" 
                                                    data-mask="(000) 000-0000" autocomplete="off" maxlength="14">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <small class="form-text text-muted">
                                                    Price at which product is to be sold at
                                                    <br>
                                                    <br>
                                                </small>
                                                <input id="price" name="price" type="number" class="form-control mb-3" placeholder=""
                                                    data-mask="(000) 000-0000" autocomplete="off" maxlength="14">
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- / .row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-1">Product Image 1</label>
                                                <small class="form-text text-muted">
                                                    Upload Product Image 1 for Product Viration (.png or .jpg)
                                                </small>
                                                <div class="row mt-3">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control" readonly type="text" name="productimage1" id="productimage1"/>
                                                        <div class="d-flex mt-2">
                                                            <button onclick="main.BtnUploadImg('photo1')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture', 'photo1', 'productimage1')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input id="photo1" style="display:none;" type="file" name="photo1" onchange="main.readURL(this, 'picture', 'productimage1')"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img class="mt-2" id="picture" style="height: 100px; width: auto;"
                                                        src="../img/default.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-1">Product Image 2</label>
                                                <small class="form-text text-muted">
                                                    Upload Product Image 2 for Product Viration (.png or .jpg)
                                                </small>
                                                <div class="row mt-3">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control" readonly type="text" name="productimage2" id="productimage2"/>
                                                        <div class="d-flex mt-2">
                                                            <button onclick="main.BtnUploadImg('photo2')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture2', 'photo2', 'productimage2')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input id="photo2" style="display:none;" type="file" name="photo2" onchange="main.readURL(this, 'picture2', 'productimage2')"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img class="mt-2" style="height: 100px; width: auto;" id="picture2"
                                                        src="../img/default.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-1">Product Image 3</label>
                                                <small class="form-text text-muted">
                                                    Upload Product Image 3 for Product Viration (.png or .jpg)
                                                </small>
                                                <div class="row">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control mt-2" readonly type="text" name="productimage3" id="productimage3"/>
                                                        <div class="d-flex mt-2">                  
                                                            <button onclick="main.BtnUploadImg('photo3')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture3', 'photo3', 'productimage3')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input style="display:none;" id="photo3" type="file" name="photo3" onchange="main.readURL(this, 'picture3', 'productimage3')"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img id="picture3" class="mt-2" style="height: 100px; width: auto;"
                                                        src="../img/default.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mb-1">Product Image 4</label>
                                                <small class="form-text text-muted">
                                                    Upload Product Image 4 for Product Viration (.png or .jpg)
                                                </small>
                                                <div class="row">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control mt-2" readonly type="text" name="productimage4" id="productimage4"/>
                                                        <div class="d-flex mt-2">                  
                                                            <button onclick="main.BtnUploadImg('photo4')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture4', 'photo4', 'productimage4')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input style="display:none;" id="photo4" type="file" name="photo4" onchange="main.readURL(this, 'picture4', 'productimage4')"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img id="picture4" class="mt-2" style="height: 100px; width: auto;"
                                                        src="../img/default.png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <hr class="mt-4 mb-5">

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <button type="button" onclick="main.doAdd_EditProject('addProduct')" class="btn btn-primary lift">
                                                Add Product
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php
                include ('../includes/footer.php');
                $sidebaractive = "$('#navlink_Project').addClass('active')";
                $quill = "main.setComplexQuillEditor('loadQuill', 'Details...');";
            ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include ('../includes/logout.php'); ?>

    <?php include ('../includes/loadscripts.php'); ?>       

</body>

</html>