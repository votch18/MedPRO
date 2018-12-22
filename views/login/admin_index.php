<div class="login-box">
    <br/>
    <br/>
        <center>
            <a href="/admin/"><h3><b><?= strtoupper(Config::get('site_name'))?></b></h3></a>
        </center>
    </div>
<div class="card card-login mx-auto mt-5">
    <?php if (Session::hasFlash()) { ?>
        <div id="alert" class="card-header alert alert-danger"><?= Session::flash(); ?></div>
    <?php } else { ?>
        <div class="card-header">Login</div>
    <?php } ?>

    <div class="card-body">


  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <br/>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
    </form>

  </div>
  <!-- /.login-box-body -->
   <hr/>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
    </div>
</div>
</div>