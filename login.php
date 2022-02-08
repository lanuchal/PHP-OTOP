<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page "  style="  
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
<div class="login-box" >
  	<?php
     if(isset($_SESSION['warning'])){
      echo "
        <div class='callout callout-warning text-center'>
          <p>".$_SESSION['warning']."</p> 
        </div>
      ";
      unset($_SESSION['warning']);
    }
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
  	<div class="login-box-body " >
    	<h4 class="login-box-msg text-warning">เข้าสู่ระบบ</h4>

    	<form action="verify.php" method="POST">
      		<div class="form-group  has-warning has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-warning has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-12">
          			<button type="submit" class="btn btn-warning btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="signup.php" class="text-center text-warning">สมัครเป็นสมาชิก</a><br>
      <a href="index.php" class="text-warning"><i class="fa fa-home "></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>