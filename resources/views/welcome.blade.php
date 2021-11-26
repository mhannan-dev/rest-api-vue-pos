<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS and Inventory</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('admin_lte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin_lte') }}/dist/css/adminlte.min.css">

    <style>
        .login-page,
        .register-page {
            background-color: #F8FAFC;
        }

    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <div id="topbar" style="display: none">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>

                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">

                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ URL::asset('admin_lte') }}/dist/img/user1-128x128.jpg"
                                        alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>


                        </div>
                    </li>

                </ul>
            </nav>
        </div>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4"
            v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forgot-password' ? false : true"
            id="sidebar" style="display: none">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ URL::asset('admin_lte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">POS and Inventory</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ URL::asset('admin_lte') }}/dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>

                        </li>


                        <li class="nav-item">
                            <router-link to="/pos" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    POS
                                </p>
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/employees" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Employee
                                </p>
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/suppliers" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Suppliers
                                </p>
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/categories" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Category
                                </p>
                            </router-link>

                        </li>

                        <li class="nav-item">
                            <router-link to="/products" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Products
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </router-link>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/stock" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stock</p>
                                    </router-link>
                                </li>

                            </ul>

                        </li>


                        <li class="nav-item">
                            <router-link to="/customers" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Customer
                                </p>
                            </router-link>

                        </li>


                        <li class="nav-item">
                            <router-link to="/expenses" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Expenses
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <router-link to="/employee-salary-list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Given Salary</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/salary" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Salary</p>
                                    </router-link>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <router-link to="/logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p>
                                    Logout
                                </p>
                            </router-link>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer" id="footer" style="display: none">
            <strong>Copyright &copy; 2014-2020 <a href="#">AdminLTE</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('admin_lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin_lte') }}/dist/js/adminlte.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Page specific script -->
    <script>
        let token = localStorage.getItem('token');
        if (token) {
            $("#sidebar").css("display", "");
            $("#footer").css("display", "");
            $("#topbar").css("display", "");
        }
    </script>
    <script>
        $(function() {
            var jqOld = jQuery.noConflict();
            $("#datepicker").datepicker();
        });
    </script>

</body>

</html>
