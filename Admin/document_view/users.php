<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/salesModel.php';
    require_once '../../system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $userModel = new Users();
    define("ROW_PER_PAGE",10);
    
    $database_username = 'root';
	$database_password = '';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=eyocommerce', $database_username, $database_password );
?>

<style>
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
#keyword{border: #CCC 1px solid; border-radius: 4px; padding: 7px;background:url("demo-search-icon.png") no-repeat center right 7px; color:gray; width:30%; float:right;}
#keyword:focus {outline: 1px solid gray; }
.btn-page{margin-right:10px;padding:5px 10px; border: #CCC 1px solid; background:#FFF; border-radius:4px;cursor:pointer;}
.btn-page:hover{background:#F0F0F0;}
.btn-page.current{background:#F0F0F0;}
</style>

<body id="page-top">

<?php	
	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	
	$sql = 'SELECT * FROM users WHERE email LIKE :keyword OR fullname LIKE :keyword OR address LIKE :keyword OR country LIKE :keyword OR town_city LIKE :keyword OR contact_info LIKE :keyword OR ordernote LIKE :keyword OR created_on LIKE :keyword ORDER BY id DESC ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
	$pagination_statement = $pdo_conn->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $pdo_conn->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>

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
                        <form name='frmSearch' action='' method='post'>
                        <div style='text-align:right;margin:20px 0px;'>
                            <input class="mb-2" placeholder="Search Keyword" type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='35'/>
                        </div>
                        <?php
                            if(!empty($result)) 
                            {
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $num = 0;
                                    foreach($result as $row) 
                                    {

                                    //**
                                    // OLD PHP CODE FOR GETTING DATA FROM DB
                                    // $users = $model->getData("SELECT * FROM users");

                                    // if(isset($users))
                                    // {
                                    //     $num = 0;
                                    //     foreach($users as $row)
                                    //     {
                                            $userid = $model->protect($row["id"]);
                                            $email = $row['email'];
                                            $fullname = $row['fullname'];
                                            $phonenumber = $row['contact_info'];

                                            $address = $row['address'];
                                            $town_city = $row['town_city'];
                                            $country = $row['country'];
                                            $zipcode = $row['zipcode'];

                                            $status = $row['status'];
                                            //$maindate = date('Y-m-d', strtotime($row['created_on']));
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
                                        <b title="<?php echo $address.", | ".$town_city.", | " .$country?>" ><?php echo $fullname ?></b>
                                    </td>
                                    <td>
                                        <b title="<?php echo $zipcode ?>" ><?php echo $phonenumber ?></b>
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
                                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="main.LoadTeamPopUpForm('user', '<?php echo $userid ?>', '')" data-toggle="modal" data-target=".bd-example-modal-lg" title="View Cart Details of <?php echo $fullname ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="" title="Delete User <?php echo $fullname ?>" onclick="doDeleteUser('<?php echo $userid ?>')">
                                            <i class="fas fa-trash" ></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            </table>
                            <?php
                                }
                                else
                                {
                            ?>
                            <div class="container">
                                <div class="row">
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
                            <?php echo $per_page_html; ?>
                            </form>
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