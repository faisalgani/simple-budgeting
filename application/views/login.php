<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <style type="text/css">
    .login-logo{
      text-align: center;
      width: 130px;
      margin: 0 auto 30px;
    }
    </style>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<link rel="icon" href="<?php echo base_url(); ?>assets/images/login.png" sizes="32x32">
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transparent Sign In Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<!-- //css files -->
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body>
    <!--header-->
    <div class="header-w3l">
     
    </div>
    <!--//header-->
    <!--main-->
    <div class="main-content-agile">
      <div class="sub-main-w3"> 
        <h2>Sign In</h2>
      <form action="<?php echo base_url(); ?>auth/login" method="post">
          <?php 
            if (!empty($message)) {
              ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <?php echo $message; ?>
                </div>
              <?php
            }
          ?>
          <h6></h6>
          <div class="navbar-right social-icons"> 
          <!--  <a href="#" class="one-w3ls" ><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
            <a href="#" class="two-w3ls" ><i class="fa fa-google-plus" aria-hidden="true"></i>Google+</a> -->
            <div class="clear"></div>
          </div>
          <h6>use your username</h6>
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Username" name="username" autofocus="true">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Password" name="password" type="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
                         
          
            <div class="clear"></div>
          <input type="submit" value="Sign in">
        </form>
      </div>

      <br>
     <font size="2">Software Developer:</font><br>
     <font size="2">Faisal Gani</font><br>
     <font size="2">Bandung - Jawa Barat - Indonesia.</font><br>
    </div>
   

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.vide.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
<!-- //js -->

</body>
</html>