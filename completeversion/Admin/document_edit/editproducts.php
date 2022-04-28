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
                <div class="container-fluid">

                     <!-- Page Heading -->
                    
                    <div class="justify-content-center tab-pane fade show active    mt-1">
                        <div class="col">

                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="h4 mb-0 text-gray-800">Edit Product
                            </h3>
                            <a href="../document_view/products.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All</a>
                        </div>

                        
                        <!-- Form -->
                        <div class="tab-pane fade show active mt-5" id="lcp-body-tab1" role="tabpanel" aria-labelledby="lcp-nav-tab1">
                        <?php
                            $sharedComponentsModel = new SharedComponents();
                            $productsModel = new Products();

                            if (isset($_GET['id'])) 
                            {
                                $ProductData = $productsModel->getProductById($_GET['id']);

                                if (isset($ProductData))
                                {
                                    $pid = $ProductData->EncryptedId;
                                    $category = $ProductData->Category_Id;
                                    $name = $ProductData->Name;
                                    $description = $ProductData->Description;
                                    $slug = $ProductData->Slug;
                                    $price = $ProductData->Price;
                                    
                                    $productimage1 = (!empty($ProductData->Photo1)) ? '../../uploads/'.$ProductData->Photo1 : '../img/default.png';

                                    $productimage2 = (!empty($ProductData->Photo2)) ? '../../uploads/'.$ProductData->Photo2 : '../img/default.png';

                                    $productimage3 = (!empty($ProductData->Photo3)) ? '../../uploads/'.$ProductData->Photo3 : '../img/default.png';

                                    $productimage4 = (!empty($ProductData->Photo4)) ? '../../uploads/'.$ProductData->Photo4 : '../img/default.png';

                                    $txtproductimage1 = $ProductData->Photo1;
                                    $txtproductimage2 = $ProductData->Photo2;
                                    $txtproductimage3 = $ProductData->Photo3;
                                    $txtproductimage4 = $ProductData->Photo4;

                                    $catname = implode(" ",$result = $sharedComponentsModel->getCategoryName($category));

                            ?>
                                <form enctype="multipart/form-data" action="../system/controller/request_handler_post.php" class="user" data-ajax-method="POST" data-ajax="true" data-ajax-complete="main.AjaxOnComplete2" data-ajax-begin="main.AjaxOnBegin2" data-ajax-success="main.AjaxOnSettingUpdate" data-ajax-failure="main.AjaxOnfailure" id="editProduct">
                                    <div class="text-center">
                                    </div>

                                    <input type="text" name="namespace" id="namespace" class="d-none" value="editProduct" hidden/>
                                    <input type="text" name="id" class="d-none" value="<?php echo $pid;?>" hidden/>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input value="<?php echo $name; ?>" id="name" name="name" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="category" class="pl-2">Product Category</label>
                                                <input name="productcategory" type="text" class="form-control" id="category" list="productcategory" placeholder="" value="<?php echo $catname?>">
                                                <datalist id="productcategory">        
                                                <?php
                                                    $category = $sharedComponentsModel->getCategory();

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
                                                <input value="<?php echo $description; ?>" id="description" name="productdescription" type="text" class="d-none" hidden />
                                                <div id="loadQuill" style="height:150px;background:white"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <small class="form-text text-muted">
                                                    This will show on the site URL when the product page is Opened, Slug should be almost or simliar to product name.
                                                </small>
                                                <input value="<?php echo $slug; ?>" id="slug" name="slug" type="text" class="form-control mb-3" 
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
                                                <input value="<?php echo $price; ?>" id="price" name="price" type="number" class="form-control mb-3" placeholder=""
                                                    data-mask="(000) 000-0000" autocomplete="off" maxlength="6">
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
                                                <div class="row">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control" readonly type="text" name="productimage1" value="<?php echo $txtproductimage1; ?>" id="productimage1"/>
                                                        <div class="d-flex mt-2">
                                                            <button onclick="main.BtnUploadImg('photo1')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture', 'photo1', 'productimage1')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input id="photo1" style="display:none;" type="file" name="photo1" onchange="main.readURL(this, 'picture', 'productimage1')" value="<?php echo $txtproductimage1; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img id="picture" class="mt-2" style="height: 100px; width: auto;"
                                                            src="<?php echo $productimage1?>">
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
                                                <div class="row">
                                                    <div class="col-auto" style="display: grid; align-items: center;">
                                                    <input class="form-control" readonly type="text" name="productimage2" value="<?php echo $txtproductimage2; ?>" id="productimage2"/>
                                                        <div class="d-flex mt-2">
                                                            <button onclick="main.BtnUploadImg('photo2')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture2', 'photo2', 'productimage2')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input id="photo2" style="display:none;" type="file" name="photo2" onchange="main.readURL(this, 'picture2', 'productimage2')" value="<?php echo $txtproductimage2; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img class="mt-2" style="height: 100px; width: auto;" id="picture2"
                                                        src="<?php echo $productimage2?>">
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
                                                    <input class="form-control" readonly type="text" name="productimage3" value="<?php echo $txtproductimage3; ?>" id="productimage3"/>
                                                        <div class="d-flex mt-2">                  
                                                            <button onclick="main.BtnUploadImg('photo3')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture3', 'photo3', 'productimage3')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input style="display:none;" id="photo3" type="file" name="photo3" onchange="main.readURL(this, 'picture3', 'productimage3')" value="<?php echo $txtproductimage3; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img id="picture3" class="mt-2" style="height: 100px; width: auto;"
                                                        src="<?php echo $productimage3?>">
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
                                                    <input class="form-control mt-2" readonly type="text" name="productimage4" value="<?php echo $txtproductimage4; ?>" id="productimage4"/>
                                                        <div class="d-flex mt-2">
                                                            <button onclick="main.BtnUploadImg('photo4')" type="button" class="btn btn-outline-primary mr-4"><i
                                                                    class="fas fa-upload mr-2"></i>upload</button>
                                                            <button onclick="main.BtnRemoveImg('picture4', 'photo4', 'productimage4')" type="button" class="btn btn-outline-danger"><i
                                                                    class="fas fa-times mr-2"></i>remove</button>
                                                            <input style="display:none;" id="photo4" type="file" name="photo4" onchange="main.readURL(this, 'picture4', 'productimage4')" value="<?php echo $txtproductimage4; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img id="picture4" class="mt-2" style="height: 100px; width: auto;" src="<?php echo $productimage4?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <!-- Divider -->
                                     <hr class="mt-4 mb-5">

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <button type="button" onclick="main.doAdd_EditProject('editProduct')" class="btn btn-primary lift">
                                                Save changes
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                            <?php
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
                include ('../includes/footer.php');
                $quill = "main.setComplexQuillEditor('loadQuill', 'Details...'); main.QuillEditor.root.innerHTML = $('#description').val();";
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

    <?php include ('../includes/logout.php'); ?>

    <?php include ('../includes/loadscripts.php'); ?>       

</body>

</html>