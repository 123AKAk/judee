<?php 
    // include '../includes/session.php';
    // include '../includes/header.php';

    require_once 'Admin/system/database/conn.php';
    require_once 'Admin/system/custom_model/sharedComponents.php';
    require_once 'Admin/system/custom_model/ProductModel.php';
    require_once 'Admin/system/custom_model/SalesModel.php';
    require_once 'system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $salesModel = new Sales();
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
        if(!empty($_GET['saledate']))
        {
?>
<div class="myaccount-table  table-responsive text-center">
    <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">$Price x Quantity</th>
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
                    if($_GET['saledate'] == $item["sales_date"])
                    {
                    //sales
                        $userid = $item["user_id"];
                        $saleamount = $item["amount"];
                        $transactionid = $item["transaction_id"];
                        $date = strtotime($item["sales_date"]);
                        $salesdate = date('F j, Y, g:i a', $date);

                        $comparedate = $item["sales_date"];

                        $anum++;
                    }
?>
<style>
    .bold{
        font-style:bold;
    }
</style>
<?php
                //cart
                $CartData = $sharedComponentsModel->getCartByUserId($sharedComponentsModel->protect($userid), $comparedate);

                if (!empty($CartData))
                {
                    $num = 0;
                    foreach($CartData as $item)
                    {
                        $name = $item["name"];
                        $price = $item["price"];
                        $quantity = $item["quantity"];

                        //product
                        //$ProductData = $productsModel->getProductById($sharedComponentsModel->protect($item["productid"]));
                        
                        //$pid = $ProductData->EncryptedId;
                        // $category = $ProductData->Category_Id;
                        // $name = $ProductData->Name;
                        //$price = $ProductData->Price;
                        // $productimage1 = (!empty($ProductData->Photo1)) ? '../../uploads/'.$ProductData->Photo1 : '../img/default.png';
                        // $catname = implode(" ",$result = $sharedComponentsModel->getCategoryName($category));
                        
                        $num++;
?>
        <tr>
            <td><?php echo $num ?></td>
            <td><?php echo $name ?></td>
            <td><?php echo "$".$price ?></td>

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