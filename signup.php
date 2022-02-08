<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }

  if(isset($_SESSION['captcha'])){
    $now = time();
    if($now >= $_SESSION['captcha']){
      unset($_SESSION['captcha']);
    }
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition register-page"  style="  
                                                position: relative; padding-top: 15rem;">
                                                <div style="  
                                                content: ' ';
                                                display: block;
                                                position: fixed;
                                                left: 0;
                                                top: 0;
                                                width: 100%;
                                                height: 100%;
                                                z-index: -1 ;
                                                padding-top: 15rem;
                                                opacity: 0.6;
                                                background-image: url('images/bg.jpg');
                                                background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('images/bg.jpg');
                                                background-color:rgba(0, 0, 0, 0.1);
                                                background-repeat: no-repeat;
                                                background-position: 0;
                                                background-size: cover;">
                                                </div>
<div class="register-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="register-box-body">
    	<h4 class="login-box-msg text-warning">สมัครสมาชิก</h4>

    	<form action="register.php" method="POST">
          <div class="form-group has-warning has-feedback">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-warning has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
      		<div class="form-group has-warning has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-warning has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-warning has-feedback">
            <input type="password" class="form-control" name="repassword" placeholder="Retype password" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <!-- <?php
            // if(!isset($_SESSION['captcha'])){
            //   echo '
            //     <di class="form-group" style="width:100%;">
            //       <div class="g-recaptcha" data-sitekey="6LevO1IUAAAAAFX5PpmtEoCxwae-I8cCQrbhTfM6"></div>
            //     </di>
            //   ';
            // }
          ?> -->
          <hr>
      		<div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                  <button type="submit" class="btn btn-warning btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> สมัคสมาชิก</button>
            </div>
      		</div>
    	</form>
      <br>
      <!-- <a href="login.php"><i class="fa fa-sign-in">asdasd</a><br> -->
      <div class="row">
        <div class="col-sm-6">
            <a href="index.php" class="text-warning"><i class="fa fa-home"></i> Home</a>
        </div>
        <div class="col-sm-6 text-right">
          <a href="login.php" class="text-warning ml-10"><i class="fa fa-sign-in"></i> login</a>
        </div>
      </div>
      
      
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>