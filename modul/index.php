<?php


session_start();
require_once("../modul/class.user.php");
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
    
<title>Sistem Pengurusan Pelaporan SIP & SISC </title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/default.css" id="theme"  rel="stylesheet">

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
              <div class="inner-panel">
                  
                  <div class="lg-content">
                      <h2>Sistem Pengurusan Pelaporan SIP & SISC</h2>
                      <p class="text-muted"> </p>
                      <a href="index.php" class="btn btn-rounded btn-danger p-l-20 p-r-20"> 
                          KEMENTERIAN PENDIDIKAN MALAYSIA</a>
                  </div>
              </div>
      </div>
    
    
    
    
    
    
      <div class="new-login-box">
          
         <header id="header">
			<div id="logo">
			 <img src="logo.png" alt="ePencen" width="400px">
     
			</div>
		</header> 
          
                <div class="white-box" style="background: linear-gradient(#FFFFF0, #FFF8DC); margin-top:2rem; border-style:solid;border-color: #808080;border-width: 2px;">
                    <h3 class="box-title m-b-0">Log Masuk </h3>
              
                  


	
     
        
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
            <button type="submit" name="btn-login" class="btn btn-primary">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; LOG MASUK
            </button>
        </div>  
      	<br />
            <label>Kementerian Pendidikan Malaysia </label>
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
