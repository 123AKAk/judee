<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/salesModel.php';
    require_once '../../system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $userModel = new Users();
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
                        <h1 class="h3 mb-0 text-gray-800">User Management
                            <small class="badge badge-secondary" style="font-size: 1rem;"> Total: 
                            <?php
                                $model = new SharedComponents();
                                echo $model->getItemCount("users");
                            ?>
                        </small>
                        </h1>
                        <a href="../../register.php" class="d-none d-sm-inline-block  btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Register new User account</a>
                    </div>
                        <div class="table-striped table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $users = $model->getData("SELECT * FROM users");

                                    if(isset($users))
                                    {
                                        $num = 0;
                                        foreach($users as $row)
                                        {
                                            $userid = $model->protect($row["id"]);
                                            $email = $row['email'];
                                            $fullname = $row['fullname'];
                                            $status = $row['status'];

                                            $date = strtotime($row['created_on']);
                                            $date = date('F j, Y, g:i a', $date);

                                            $num++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $num ?></th>
                                    <td>
                                        <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
                                    </td>
                                    <td>
                                        <b><?php echo $fullname ?></b>
                                    </td>
                                    <td>
                                        <?php 
                                            if($status == 1)
                                            {
                                        ?>
                                            <i class="fas fa-solid fa-user-shield" title="Activated" style="color:#1cc88a;"></i>
                                        <?php 
                                            }
                                            else
                                            {
                                        ?>
                                        <i class="fas fa-solid fa-user-lock" title="Not Activated" style="color:#e74a3b;"></i>
                                        <?php 
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $date ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="main.LoadTeamPopUpForm('user', '<?php echo $userid ?>')" data-toggle="modal" data-target=".bd-example-modal-lg" title="View Cart Details of <?php echo $fullname ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="" title="Delete User <?php echo $fullname ?>" onclick="main.doDeleteSale('<?php echo $userid ?>')">
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

                <!-- modal Start -->
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
                <!-- modal End -->
            </div>
            <!-- End of Main Content -->

            <?php include '../includes//footer.php'; ?>
            <?php
                $sidebaractive = "$('#navlink_Sponsorship').addClass('active')";
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