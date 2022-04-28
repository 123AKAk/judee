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
                                    <li class="breadcrumb-item active" aria-current="page">Payment Successful Page</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="">
<?php
    //echo urlencode(serialize($datasales))
    if(isset($_SESSION["cart_item"]))
    {
        if(isset($_GET['transactionid']) && isset($_GET['userid']) && isset($_GET['amount']))
        {
?>
                        <!-- Register Content Start -->
                        <div class="col">
							<h4 class="mb-3 text-center">Payment Successful</h4>
                            <div class="login-reg-form-wrap sign-up-form">    
                                <!-- Main content -->
								<section class="">
									<div class="container">
										<div class="col">
<?php
            $transactionid = $_GET['transactionid'];
            $userid = $sharedmodel->unprotect($_GET['userid']);
            $amount = $_GET['amount'];

            $datasales = array();
            foreach ($_SESSION["cart_item"] as $item)
            {
                $productsModel = new Products();

                $ProductData = $productsModel->getProductById($sharedmodel->protect($item["id"]));

                if (isset($ProductData))
                {
                    $productid = $sharedmodel->unprotect($ProductData->EncryptedId);
                    $categoryid = $ProductData->Category_Id;
                    $category = $ProductData->Category_Id;
                    $name = $ProductData->Name;
                    $description = $ProductData->Description;
                    $slug = $ProductData->Slug;
                    $price = $ProductData->Price;
                    
                    $item_price = $item["quantity"]*$price;

                    //add data to an array
                    $maindata = ['userid' => $userid, 'productid' => $productid, 'name' => $name, 'price' => $item_price, 'quantity' => $item["quantity"]];
                    
                    $datasales[] = $maindata;
                }
            }

            if (isset($datasales))
            {
                $newarray = $datasales;
                //$newarray = unserialize(urldecode($datasales));

                //formats the array
                function array_custom($arraynew)
                {
                    $result = [];
                    foreach ($arraynew as $key=>$value)
                    {
                        foreach($value as $k=>$v)
                        {
                            $result[$k] = $v;
                        }
                    }
                    return $result;
                }

                require_once('system/models/userProductModel.php');
                $productsModel = new Products();

                //insert sales data to database
                $runsaledata = $productsModel->runSales($userid, $amount, $transactionid);
                if (isset($runsaledata))
                {
                    echo $runsaledata["message"];
                    
                    echo "<br>";echo "<Hr>";

                    //gets the data from the array to format
                    $keys = array_keys($newarray);
                    for($i = 0; $i < count($newarray); $i++)
                    {
                        $merge = array();
                        foreach($newarray[$keys[$i]] as $key => $value)
                        {
                            $merge[] = [$key=>$value];
                            //$merge[] = $value;
                            //$merge[] = array($key=>$value);
                        }

                        //insert cart data to database
                        $runcartdata = $productsModel->runCartSales(array_custom($merge));

                        if (isset($runcartdata))
                        {
                            //echo $runcartdata["message"];
                        }
                        else
                        {
                            echo "Error Getting Feedback Response";
                        }
                    }
                }
                else
                {
                    echo "Error Getting Feedback Response (Reporting Sales)";
                }
            }
            else
            {
                echo "Invalid Response <br><br>";
                echo "Redirecting...";

                echo("<script> setTimeout(function(){location.replace('./');},1500)</script>");
            }
        }
    }
    else
    {
        echo "<b>Error Getting User Cart Details, you might have made payment or you have no Item in your Cart</b>";
        echo "<br>";
        echo "<p>Click <a href='./'>here</a> to go to the <a href='./'>Home Page</a></p>";
    }
?>
										</div>
									</div>
								</section>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

    <?php
        include 'includes/footer.php';
        include 'includes/modal.php';
        include 'includes/scripts.php';

        if (isset($runcartdata))
        {
            json_encode($runcartdata);
    ?>
        <script type="text/javascript"> docart(0, "emptyCart", 99); </script>
    <?php
        }
    ?>
</html>