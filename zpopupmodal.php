<?php
    require_once('system/models/userSharedComponents.php');
    require_once('system/models/userProductModel.php');
    require_once('system/database/conn.php');

    $productsModel = new Products();
    $sharedmodel = new SharedComponents();

    if(isset($_GET['id']))
	{
        $product = $productsModel->getProductById($_GET['id']);

        if (isset($product))
        {
            $productid = $product->EncryptedId;
            $categoryid = $product->Category_Id;
            $categoryida = $product->Category_Id;
            $name = $product->Name;
            $description = $product->Description;
            $price = $product->Price;
            $photo1 = $product->Photo1;
            $photo2 = $product->Photo2;
            $photo3 = $product->Photo3;
            $photo4 = $product->Photo4;

            //$FeaturedImage1 = (!empty($photo1)) ? 'uploads/'.$photo1 : 'assets/img/default.png';
            $FeaturedImage2 = (!empty($photo2)) ? 'uploads/'.$photo2 : 'uploads/'.$photo1.'';
            // $FeaturedImage3 = (!empty($photo3)) ? 'uploads/'.$photo3 : 'uploads/'.$photo1.'';
            // $FeaturedImage4 = (!empty($photo4)) ? 'uploads/'.$photo4 : 'uploads/'.$photo1.'';

            $catname = implode(" ",$sharedmodel->getCategoryName($categoryida));
?>
    <!-- product details inner end -->
    <div class="product-details-inner">
        <div class="row">

            <div class="col-lg-4">
                <div class="product-large-slider" style="width:200px; height:230px">
                    <div class="pro-large-img img-zoom" style="width:200px; height:230px">
                        <center>
                            <img src="<?php echo $FeaturedImage2 ?>" alt="<?php echo $name ?> Annibel product-details" style="width:230px; height:230px"/>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="container">
                    <div class="product-details-des">
                        <div class="manufacturer-name">
                            <a href="category.php?id=<?php echo $categoryid ?>"><?php echo $catname ?></a>
                        </div>
                        <a href="product.php?id=<?php echo $productid ?>" style="color:black">
                            <h3 class="product-name">
                                <?php echo $name ?></a>
                            </h3>
                        </a>
                        <div class="price-box">
                        <span class="price-regular">$ <?php echo $price ?></span>
                        </div>
                        <p class="pro-desc">
                            <?php echo $description ?>
                        </p>
                        <div class="quantity-cart-box d-flex align-items-center">
                            <h6 class="option-title">qty:</h6>
                            <div class="quantity">
                                <div class="pro-qty"><input type="text" value="1" readonly  ></div>
                            </div>
                            <div class="action_link">
                                <a class="btn btn-cart2" href="javascript:void(0)" onclick="docart('<?php echo $productid; ?>', 'addCart')">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- product details inner end -->
<?php
    }
}
else
{
?>
<div class="container">
    <h4>Sorry that Product is not Available</h4>
</div>
<?php
}
?>