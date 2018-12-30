<!DOCTYPE html>
<html>
<head>

    <title><?=ucwords(strtolower(Setting::get("site_name"))) ?></title>

  
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 4</title>

    <!-- Fontfaces CSS-->
    <link href="/assets/admin/css/font-face.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/assets/admin/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="/assets/admin/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/assets/admin/css/theme.css" rel="stylesheet" media="all">
    
    <link rel="/assets/js/sweetalert2/sweetalert2.css" rel="stylesheet">
    <script src="/assets/js/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Jquery JS-->
    <script src="/assets/admin/vendor/jquery-3.2.1.min.js"></script>

</head>
<body class="animsition">
<div class="page-wrapper">

<?php if (App::getRouter()->getController() != null && App::getRouter()->getController() == 'login') { ?>

    <?php echo $content['content_html']; ?>

<?php } else { ?>

        <!-- HEADER DESKTOP-->
        <header class="header-desktop4">
            <div class="container">
                <div class="header4-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <h1>MedPro</h1>
                        </a>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-button-item js-item-menu">
                            <i class="zmdi zmdi-settings"></i>
                            <div class="setting-dropdown js-dropdown">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-globe"></i>Language</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-pin"></i>Location</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-email"></i>Email</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">john doe</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">john doe</a>
                                            </h5>
                                            <span class="email">johndoe@example.com</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="#">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP -->

        <!-- WELCOME-->
        <section class="welcome2 p-t-40 p-b-55">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb3">
                            <div class="au-breadcrumb-left">
                                <span class="au-breadcrumb-span">You are here:</span>
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome2-inner m-t-60">
                            <div class="welcome2-greeting">
                                <h1 class="title-6">Hi
                                    <span>John</span>, Welcome back</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                            <form class="form-header form-header2" action="" method="post">
                                <input class="au-input au-input--w435" type="text" name="search" placeholder="Search for datas &amp; reports...">
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->



          <!-- PAGE CONTENT-->
          <div class="page-container3">
            <section class="alert-wrap p-t-70 p-b-70">
                <div class="container">
                    <!-- ALERT-->
                    <div class="alert au-alert-success alert-dismissible fade show au-alert au-alert--70per" role="alert">
                        <i class="zmdi zmdi-check-circle"></i>
                        <span class="content">You successfully read this important alert message.</span>
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="zmdi zmdi-close-circle"></i>
                            </span>
                        </button>
                    </div>
                    <!-- END ALERT-->
                </div>
            </section>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            <!-- MENU SIDEBAR-->
                            <aside class="menu-sidebar3 js-spe-sidebar">
                                <nav class="navbar-sidebar2 navbar-sidebar3">
                                    <ul class="list-unstyled navbar__list">
                                        <li class="active has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                <li>
                                                    <a href="index.html">Dashboard 1</a>
                                                </li>
                                                <li>
                                                    <a href="index2.html">Dashboard 2</a>
                                                </li>
                                                <li>
                                                    <a href="index3.html">Dashboard 3</a>
                                                </li>
                                                <li>
                                                    <a href="index4.html">Dashboard 4</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="inbox.html">
                                                <i class="fas fa-chart-bar"></i>Inbox</a>
                                            <span class="inbox-num">3</span>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-shopping-basket"></i>Products</a>
                                        </li>
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-trophy"></i>Ratings
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                <li>
                                                    <a href="table.html">Tables</a>
                                                </li>
                                                <li>
                                                    <a href="form.html">Forms</a>
                                                </li>
                                                <li>
                                                    <a href="#">Calendar</a>
                                                </li>
                                                <li>
                                                    <a href="map.html">Maps</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="has-sub">
                                            <a class="js-arrow" href="#">
                                                <i class="fas fa-copy"></i>Account
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                <li>
                                                    <a href="login.html">Login</a>
                                                </li>
                                                <li>
                                                    <a href="register.html">Register</a>
                                                </li>
                                                <li>
                                                    <a href="forget-pass.html">Forget Password</a>
                                                </li>
                                            </ul>
                                        </li>
                                      
                                    </ul>
                                </nav>
                            </aside>
                            <!-- END MENU SIDEBAR-->
                        </div>
                        <div class="col-xl-9">
                            <!-- PAGE CONTENT-->
                            <div class="page-content">
                                <div class="row">
                                    
                                    
                                        <?php echo $content['content_html']; ?>


                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="copyright">
                                            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE CONTENT-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END PAGE CONTENT  -->
    </div>       

    <?php } ?>
             
   
    <!-- Bootstrap JS-->
    <script src="/assets/admin/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="/assets/admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="/assets/admin/vendor/slick/slick.min.js">
    </script>
    <script src="/assets/admin/vendor/wow/wow.min.js"></script>
    <script src="/assets/admin/vendor/animsition/animsition.min.js"></script>
    <script src="/assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="/assets/admin/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="/assets/admin/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="/assets/admin/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="/assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/admin/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="/assets/admin/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="/assets/admin/js/main.js"></script>


            <script>
          
            //delete data in any table with id = ataTable
            $('#dataTable tbody').on( 'click', '.btn-delete', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                
                    if (result.value) {
                        //proceed to deletion
                        window.location = url;
                    }
                    
                });
            } );


              //restore member 
              $('#dataTable tbody').on( 'click', '.btn-restore', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');

                swal({
                    title: 'Are you sure?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                
                    if (result.value) {
                        //proceed to deletion
                        window.location = url;
                    }
                    
                });
            } );
        </script>
</body>
</html>
