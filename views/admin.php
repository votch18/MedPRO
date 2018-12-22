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
    <!--<script src="/vendor/jquery/jquery.min.js"></script>-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/ajax.js"></script>
    <!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <link rel="stylesheet" type="text/css" id="u0" href="http://cdn.tinymce.com/4/skins/lightgray/skin.min.css">-->
    <link href="/css/print.min.css" rel="stylesheet">
	<link href="/css/stepper.css" rel="stylesheet">
    <link rel="/js/sweetalert2/sweetalert2.css" rel="stylesheet">

    <script src="/js/print.min.js"></script>
    <script src="/js/sweetalert2/sweetalert2.all.min.js"></script>


</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

   <?php

   $access = Session::get('access');
   //if (isset($access)) include_once '_template/admin_header.php';
   if (isset($access)) include_once '_template/admin_menu.php';

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
                          <div id="alert" class="alert alert-danger text-center"><?= Session::flash(); ?></div><?php
                      } ?>

                      <?php echo $content['content_html']; ?>

                  </div>
              </div>
              <!-- /.container-fluid-->
              <!-- /.content-wrapper-->
              <footer class="sticky-footer">
                  <div class="container">
                      <div class="text-center">
                          <small>Copyright © <?=ucwords(strtolower(Config::get("site_name"))) ?></small>
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
                              <a class="btn btn-primary" href="/admin/users/logout/">Logout</a>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Bootstrap core JavaScript-->
              <script src="/vendor/jquery/jquery.min.js"></script>
                <!--<script src="/js/jquery-ui.js"></script>-->
            <script src="/js/jquery-ui.min.js"></script>
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
              <!--<script src="/js/sb-admin-charts.min.js"></script>-->
              <script src="/js/admin.js"></script>

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
    <?php } ?>
</body>
</html>
