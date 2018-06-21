<?php

//error_reporting(0);

session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('./menu.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
  
		
	if($login->doLogin($uname,$umail,$upass))
        
	{
		$login->redirect('../modul/menu.php');
	}
	else
	{
		$error = "Pengguna Tidak Berjaya !";
	}	
}
?>



<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Portal Rasmi - Sistem Pengurusan MPertukaran Murid Johor</title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/default.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
              <div class="inner-panel">
                  <a href="javascript:void(0)" class="p-20 di"><img src="../plugins/images/admin-logo.png"></a>
                  <div class="lg-content">
                      <h2>SISTEM PENGURUSAN & PERTUKARAN MURID JOHOR </h2>
                      <p class="text-muted">JABATAN PENDIDIKAN NEGERI JOHOR </p>
                      <a href="index.php" class="btn btn-rounded btn-danger p-l-20 p-r-20"> 
                          ePMJ - Sistem Pengurusan Pertukaran Murid Johor</a>
                  </div>
              </div>
      </div>
    
    
    
    
    
    
      <div class="new-login-box">
          
         <header id="header">
			<div id="logo">
			 <img src="../banner.jpg" alt="ePMJ" style="width:1014px;height100px;border:0;">
     
			</div>
		</header> 
          
                <div class="white-box">
                    <h3 class="box-title m-b-0">Log Masuk ePMJ Online</h3>
                    <small>Sistem Pengurusan Pertukaran Murid Johor</small>
                    
                  


	
     
        
       <form class="form-signin" method="post" id="login-form">
      
        
           
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
           
           
       
        
        <div class="form-group">
        <input size="20" type="text" class="form-control" name="txt_uname_email" placeholder="Taipkan Nama Pengguna" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Taipkan kata laluan" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; LOG MASUK
            </button>
        </div>  
      	<br />
            <label>Daftar untuk pengguna baru ! <a href="#">Daftar Pengguna</a></label>
      </form>
                  
                  <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                      </div>
                    </div>
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                      </div>
                    </div>
                  </form>
                    
                    
                    
                    
                </div>
      </div>            
      


  
</section>
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
