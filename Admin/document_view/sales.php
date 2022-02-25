<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/salesModel.php';
    require_once '../../system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $salesModel = new Sales();
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../includes//sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../includes//navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="container pb-5 mb-4">
                       <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sales Management
                            <small class="badge badge-secondary" style="font-size: 1rem;"> Total: 
                            <?php
                                $sharedmodel = new SharedComponents();
                                echo $sharedmodel->getItemCount("sales");
                            ?>
                        </small>
                        </h1>
                    </div>
                        <div class="table-striped table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">User Names</th>
                                <th scope="col">Transaction Id</th>
                                <th scope="col">Sales Date</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sales = $sharedmodel->getData("SELECT * FROM sales ORDER BY id ASC");

                                if (!empty($sales))
                                {
                                    $num = 0;
                                    foreach($sales as $item)
                                    {
                                        $salesid = $sharedmodel->protect($item["id"]);
                                        $user_id = $item["user_id"];
                                        $amount = $item["amount"];
                                        $transaction_id = $item["transaction_id"];
                                        $sales_date = $item["sales_date"];

                                        $sales_date = new DateTime($sales_date);
                                        $date = $sales_date->format('d')." ".$sales_date->format('M')."' ". $sales_date->format('y');


                                        //get user details based on userId
                                        $userModel = new Users();
                                        $UserData = $userModel->getUserById($sharedmodel->protect($user_id));

                                        $statusername = "Null [No Name]";
                                        if (isset($UserData))
                                        $statusername = $UserData->Fullname;

                                        $num++;
                                ?>
                                <tr>
                                    <td scope="row"><?php echo $num ?></td>
                                    <td>
                                        <a href="editusers?id=<?php echo $user_id ?>" style="text-decoration:none">
                                            <?php echo $statusername ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $transaction_id ?>
                                    </td>
                                    <td>
                                        <?php echo $date ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="main.LoadTeamPopUpForm('sale', '<?php echo $salesid ?>')" title="View Details" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="" title="Delete Sale" onclick="main.doDeleteSale('<?php echo $salesid ?>')">
                                            <i class="fas fa-trash" ></i>
                                        </button>
                                    </td>
                                </tr>
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
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Large modal -->

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="teamFormModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div id="loader" style="padding: 50px;display: flex;justify-content: center;">
                                <div class="spinner-border mr-2" role="status" style="width: 1.4rem;height: 1.4rem;">
                                    <span class="sr-only">Loading...</span>
                                </div>  Loading...
                            </div>
                            <div id="loadTeamPopUpForm" class="d-none">

                            </div>
                        </div>
                    </div>
                </div>
              

            </div>
            <!-- End of Main Content -->

            <?php include '../includes//footer.php'; ?>
            <?php
                $sidebaractive = "$('#navlink_Donations').addClass('active')";
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