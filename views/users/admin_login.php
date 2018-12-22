<div class="content_wrapper" class="content">

<div class="login_wrapper">


        <center><img src="/images/sflogo.png" class="logo pulse"/></center>
        <hr/>

  <?php if (Session::hasFlash()) { ?>
  <div class="wrap">
      <div id="alert" class="alert alert-danger">
        <?= Session::flash(); ?>
      </div>
  </div>
  <?php } ?>
    <center><h3 class="login-msg">LOGIN TO YOUR ACCOUNT</h3></center>
    <br/>
    <form method="POST">
        <div class="input-group input-group-lg">
            <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="sizing-addon1" required>
            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user fa-fw"></i></span>
        </div>
        <br/>
        <div class="input-group input-group-lg">
            <input type="password" name="password" placeholder="Password" class="form-control" aria-describedby="sizing-addon1" required>
            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key fa-fw"></i></span>
        </div>
        <br/>
        <button type="submit" class="btn btn-success" name="btnlogin"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Sign-in</button>
        <hr/>
        <br/>
    </form>
</div>
</div>
