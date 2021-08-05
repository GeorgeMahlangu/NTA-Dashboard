<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: user/home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background-image:url('assets/img/intro-bg.jpg'); background-repeat: no-repeat; background-size: cover;">
<div class="login-box">
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
  	<div class="login-box-body">
    	<p class="login-box-msg">Register to NTA Dashboard</p>

    	<form action="register.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="firstname" placeholder="Please enter your Firstname" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
              <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="lastname" placeholder="Please enter your Lastname" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
              <div class="form-group has-feedback">
        		<input type="text" class="form-control" name="email" placeholder="Please Enter your Email" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
           
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="verify_password" placeholder="Verify password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="register"><i class="fa fa-sign-in"></i> Register</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="login.php"><i class="fa fa-user"></i> Already Have an Account</a><br>
      <!-- <a href="signup.php" class="text-center">Register a new membership</a><br> -->
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>