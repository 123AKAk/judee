<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/ProductModel.php';
    require_once '../system/custom_model/salesModel.php';
    require_once '../../system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $salesModel = new Sales();
    $userModel = new Users();
    $productsModel = new Products();
?>
<style>
    .hiden {
        overflow: hidden;
    }
    
    @media screen and (max-width: 465px)
    {
        .hiden {
            overflow: scroll;

        }
    }
</style>
<div class="container" style="background:whitesmoke">
<div class="m-2">
    <h5 class="mb-2 pt-3">
        <?php 
            if(isset($_GET['id']))
                echo ($_GET['page'] == "sale") ? 'Transaction Full Details' : 'User Cart Details';
        ?>
    </h5>
    <hr>
<?php
    if(isset($_GET['id']))
    {
        if($_GET['page'] == "sale")
        {
?>
<div class="table-striped table-responsive hiden">
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
        </tr>
    </thead>
    <tbody>
<?php
            $SaleData = $salesModel->getSalesByIda($_GET['id']);
            
            if (isset($SaleData))
            {
                $anum = 0;
                foreach($SaleData as $item)
                {

                //sales
                $userid = $item["user_id"];
                $saleamount = $item["amount"];
                $transactionid = $item["transaction_id"];
                $date = strtotime($item["sales_date"]);
                $salesdate = date('F j, Y, g:i a', $date);

                $anum++;

?>
<style>
    .bold{
        font-style:bold;
    }
</style>
<div class="row">
    <div class="col-md-4 bold">
        <b><?php echo $anum ?>. </b>
        <p class="badge badge-secondary p-2">Total Amount: <b><?php echo "&#36;".$saleamount ?> </b></p>
    </div>
    <div class="col-md-4 bold">
        <p class="badge badge-primary p-2" >Transaction Id: <b><?php echo $transactionid ?></b></p>
        
    </div>
    <div class="col-md-4 bold">
        <p class="badge badge-success p-2" style="float:right">Date: <?php echo $salesdate ?></p>
    </div>
</div>
<?php
                //cart
                $CartData = $sharedComponentsModel->getCartByUserId($sharedComponentsModel->protect($userid));

                if (!empty($CartData))
                {
                    $num = 0;
                    foreach($CartData as $item)
                    {
                        $productid = $sharedComponentsModel->protect($item["product_id"]);
                        $quantity = $item["quantity"];

                        //product
                        $ProductData = $productsModel->getProductById($productid);
                        
                        $pid = $ProductData->EncryptedId;
                        $category = $ProductData->Category_Id;
                        $name = $ProductData->Name;
                        $price = $ProductData->Price;
                        $productimage1 = (!empty($ProductData->Photo1)) ? '../../uploads/'.$ProductData->Photo1 : '../img/default.png';
                        $catname = implode(" ",$result = $sharedComponentsModel->getCategoryName($category));
                        
                        $num++;
?>
        <tr>
            <td><?php echo $num ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $price ?></td>

            <td style="color:dodgerblue"><?php echo $quantity ?></td>
        </tr>
<?php
                        }
                    }
                }
            }
        }
?>
</tbody>
</table>
</div>
<?php
        if($_GET['page'] == "user")
        {
?>
<div class="table-striped table-responsive hiden">
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Category</th>
        </tr>
    </thead>
    <tbody>
<?php
            //cart
            $CartData = $sharedComponentsModel->getCartByUserId($_GET['id']);
            if (isset($CartData))
            {
                $num = 0;
                foreach($CartData as $item)
                {
                    $productid = $sharedComponentsModel->protect($item["product_id"]);
                    $quantity = $item["quantity"];

                    //product
                    $ProductData = $productsModel->getProductById($productid);
                    
                    $pid = $ProductData->EncryptedId;
                    $category = $ProductData->Category_Id;
                    $name = $ProductData->Name;
                    $price = $ProductData->Price;
                    $productimage1 = (!empty($ProductData->Photo1)) ? '../../uploads/'.$ProductData->Photo1 : '../img/default.png';
                    $catname = implode(" ",$result = $sharedComponentsModel->getCategoryName($category));

                    $num++;
?>
        <!-- cart -->
        <tr>
            <td><?php echo $num ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo $price ?></td>
            <td><?php echo $quantity ?></td>
            <td><?php echo $catname ?></td>
        </tr>
        <?php
                }
        ?>
        </tbody>
    </table>
    </div>
</div>
</div>
<?php
            }
        }
    }
    else
    {
?>
<div class="containerp-fluid">
    <div class="">
        <div class="card-header" style="border:none">
            <div class="row align-items-center" style="text-align:center;">
                <div class="col">
                    <!-- Title -->
                    <h6 class="card-header-title text-muted m-4">
                        Ooops! sorry no record at the moment
                    </h6>
                </div>
            </div> <!-- / .row -->
        </div>
    </div>
</div>
<?php
    }
?>