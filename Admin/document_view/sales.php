<?php 
    include '../includes/session.php';
    include '../includes/header.php';

    require_once '../system/database/conn.php';
    require_once '../system/custom_model/sharedComponents.php';
    require_once '../system/custom_model/salesModel.php';
    require_once '../../system/models/userAccountModel.php';

    $sharedComponentsModel = new SharedComponents();
    $salesModel = new Sales();

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
	
	$sql = 'SELECT * FROM sales WHERE sales_date LIKE :keyword OR transaction_id LIKE :keyword ORDER BY id DESC ';
	
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
                                <th scope="col">User Names</th>
                                <th scope="col">Transaction Id</th>
                                <th scope="col">Sales Date</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $num = 0;
                                    foreach($result as $row) 
                                    {
                                        $salesid = $sharedmodel->protect($row['id']);
                                        $user_id = $row['user_id'];
                                        $amount = $row['amount'];
                                        $transaction_id = $row['transaction_id'];
                                        $sales_date = $row['sales_date'];

                                //**
                                // OLD PHP CODE FOR GETTING DATA FROM DB
                                // $sales = $sharedmodel->getData("SELECT * FROM sales ORDER BY id ASC");

                                // if (!empty($sales))
                                // {
                                //     foreach($sales as $item)
                                //     {
                                //         $salesid = $sharedmodel->protect($item["id"]);
                                //         $user_id = $item["user_id"];
                                //         $amount = $item["amount"];
                                //         $transaction_id = $item["transaction_id"];
                                //         $sales_date = $item["sales_date"];

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
                                        <a style="text-decoration:none">
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
                                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="" title="Delete Sale" onclick="doDeleteSale('<?php echo $salesid ?>')">
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