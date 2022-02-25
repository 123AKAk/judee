<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-1">Annibel Jewelry</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item" id="navlink_Dashboard">
                <a class="nav-link" href="../document_view/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                System
            </div>

            <!-- Nav Item - Projects Collapse Menu -->
            <li class="nav-item" id="navlink_Project">
                <a class="nav-link d-none d-sm-block" href="../document_view/products.php">
                    <i class="fas fa-solid fa-gem"></i>
                    <span>Products</span>
                </a>
                <a class="nav-link d-sm-none d-block" href="../document_view/products.php" data-toggle="collapse"
                    data-target="#collapseProjects" aria-expanded="true" aria-controls="collapseProjects">
                    <i class="fas fa-solid fa-gem"></i>
                    <span>Products</span>
                </a>
                <div id="collapseProjects" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Product Management</h6>
                        <a class="collapse-item" href="../document_creation/addproducts.php">Create New</a>
                        <a class="collapse-item" href="../document_view/products.php">List All</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Donations Collapse Menu -->
            <li class="nav-item" id="navlink_Donations">
                <a class="nav-link d-none d-sm-block" href="../document_view/sales.php">
                    <i class="fas fa-solid fa-money-bill"></i>
                    <span>Sales</span>
                </a>
                <a class="nav-link d-sm-none d-block" href="../document_view/sales.php" data-toggle="collapse"
                    data-target="#collapseDonations" aria-expanded="true" aria-controls="collapseDonations">
                    <i class="fas fa-solid fa-money-bill"></i>
                    <span>Sales</span>
                </a>
                <div id="collapseDonations" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sales Management</h6>
                        <!-- <a class="collapse-item" href="../document_creation/createDonation.php">Create New</a> -->
                        <a class="collapse-item" href="../document_view/sales.php">List All</a>
                    </div>
                </div>

            </li>

            <li class="nav-item" id="navlink_Sponsorship">
                <a class="nav-link d-none d-sm-block" href="../document_view/users.php">
                <i class="fas fa-solid fa-user"></i>
                    <span>Users</span>
                </a>
                <a class="nav-link d-sm-none d-block" href="../document_view/users.php" data-toggle="collapse"
                    data-target="#collapseSponsorship" aria-expanded="true" aria-controls="collapseSponsorship">
                    <i class="fas fa-solid fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseSponsorship" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Management</h6>
                        <a class="collapse-item" href="../document_creation/addusers.php">Create New</a>
                        <a class="collapse-item" href="../document_view/users.php">List All</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="../img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>AJ Admin Pro</strong> is packed with premium features, components,
                    and more!</p>
                <a class="btn btn-success btn-sm" href="#">Upgrade to
                    Pro!</a>
            </div>

        </ul>