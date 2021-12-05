<nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand d-none d-sm-block" href="index.php"> Dashboard</a><button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
    <ul class="navbar-nav align-items-center ml-auto">
        <small class="p-1">Admin</small>

        <li class="nav-item dropdown no-caret mr-3 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="./assets/img/sujaan.svg" /></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="./assets/img/sujaan.svg" alt="Photo" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">
                            Admin
                        </div>
                        <div class="dropdown-user-details-email">
                            admin.dc@gmail.com
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon">
                        <i data-feather="log-out"></i>
                    </div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <a class="nav-link collapsed mt-4" href="index.php">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboard
                    </a>


                    <a class="nav-link" href="branch.php">
                        <div class="nav-link-icon"><i class="fas fa-building"></i></div>
                        Branch
                    </a>

                    <a class="nav-link" href="member.php">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Member
                    </a>

                    <a class="nav-link" href="member-log.php">
                        <div class="nav-link-icon"><i class="fas fa-address-book"></i></div>
                        Member Log
                    </a>

                    <a class="nav-link" href="payment.php">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Payment
                    </a>
                    <a class="nav-link" href="user.php">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        User
                    </a>
                </div>
            </div>
        </nav>
    </div>