<!DOCTYPE html>
<html>
<head>
    <title><?=ucwords(strtolower(Setting::get("site_name"))) ?></title>

    <!-- Bootstrap core CSS-->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/ajax.js"></script>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php

$access = Session::get('access');
//if (isset($access)) include_once '_template/admin_header.php';
if (isset($access)) include_once '_template/u_menu.php';

?>


<?php if (App::getRouter()->getController() != null && App::getRouter()->getController() == 'login') { ?>

    <?php echo $content['content_html']; ?>

<?php } else { ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
                <?php if (App::getRouter()->getController() != null && App::getRouter()->getController() != 'home') echo '<li class="breadcrumb-item"><a href="/admin/'.App::getRouter()->getController().'/">'.ucfirst(App::getRouter()->getController()).'</a></li>'; ?>
                <?php if (App::getRouter()->getController() != null && App::getRouter()->getAction() != null && App::getRouter()->getAction() != 'index') echo '<li class="breadcrumb-item"><a href="/admin/'.App::getRouter()->getController().'/'.App::getRouter()->getAction().'/">'.ucwords(str_replace('_', ' ', App::getRouter()->getAction())).'</a></li>'; ?>
            </ol>

            <?php if (Session::hasFlash()) {
                ?>
                <center><div id="alert" class="alert alert-danger"><?= Session::flash(); ?></div></center><?php
            } ?>

            <?php echo $content['content_html']; ?>

        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © <?=ucwords(strtolower(Setting::get("site_name"))) ?></small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>
    <script src="/js/sb-admin-charts.min.js"></script>
    <script src="/js/admin.js"></script>
    </div>
<?php } ?>
</body>
</html>