<?php

	@require_once("../modul/session.php");
	require_once("../modul/class.user.php");
	$auth_user = new USER();

	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users_kew WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $tingkatan=$userRow['tingkatan'];
    $namapengguna=$userRow['user_name'];
    $kelas=$userRow['kelas'];
    $namapenuh=$userRow['real_name'];
    $kodsekolah=$userRow['kodsekolah'];
    $kodppd=$userRow['kodppd'];
    $kodnegeri=$userRow['kodnegeri'];
    $userlevel=$userRow['userlevel'];



    $sqln = $auth_user->runQuery("SELECT * FROM tssekolah  WHERE KODSEKOLAH=:namapengguna");
	$sqln->execute(array(":namapengguna"=>$namapengguna));
    $sqlnRow=$sqln->fetch(PDO::FETCH_ASSOC);
    $namasekolah=$sqlnRow['NAMASEKOLAH'];



 @$id= $_GET['id'];

if($userlevel=="10"){

if(!empty($_POST["save_record"])) {

$sql = $auth_user->runQuery("INSERT INTO bersara_nama
        (NOKP,NAMAGURU,KODSEKOLAH,KODPPD,JAWATAN,GRED,JENISBESARA,TARIKHBESARA) VALUES (:1,:2,:3,:4,:5,:6,:7,:8)");  
    
        $nokp=$_POST['NOKP'];
		$nama= $_POST['NAMAGURU'];
        $kodsekolah=$_POST['KODSEKOLAH'];
		$kodppd= $_POST['KODPPD'];
        $gred=$_POST['GRED'];
		$jawatan= $_POST['JAWATAN'];
        $jenissara=$_POST['JENISBESARA'];
$dari=$_POST['TARIKHBESARA'];
    
         $dari_hari = $_POST['dari_hari'];
         $dari_bulan = $_POST['dari_bulan'];
         $dari_tahun = $_POST['dari_tahun'];
         $dari_jam = "00";
         $dari_minit = "00";

           $dari = $dari_tahun."-".$dari_bulan."-".$dari_hari." ".$dari_jam.":".$dari_minit.":00";
    

          $nama = strtoupper($nama); 
          $jawatan = strtoupper($jawatan); 
    
        $sql->bindParam(':1',$nokp);
		$sql->bindParam(':2',$nama);
        $sql->bindParam(':3',$kodsekolah);
		$sql->bindParam(':4',$kodppd);
        $sql->bindParam(':5',$jawatan);
        $sql->bindParam(':6',$gred);
		$sql->bindParam(':7',$jenissara);
        $sql->bindParam(':8',$dari);
    
		if($sql->execute()) {
			$success_message = "Added Successfully";
            
             header("Location: index.php?id=pencen");
             
            
		} else {
			$error_message = "Problem in Adding New Record";
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
    <title>Sistem Pengurusan Maklumat Pencen Pegawai dan AKP PPD Kluang</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    
     <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    
    
    
    
    
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="#">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="../logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="../" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="../" alt="home" class="dark-logo" /><!--This is light logo text--><img src="../" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-gmail"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                   
                             
                                    
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- .Task dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-check-circle"></i>
                            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <!-- .Megamenu -->
                    <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Mega</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Forms Elements</li>
                                    <li><a href="form-basic.html">Basic Forms</a></li>
                                  
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Advance Forms</li>
                                    <li><a href="form-dropzone.html">File Dropzone</a></li>
                                  
                                </ul>
                            </li>
                         
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Charts</li>
                                    <li> <a href="flot.html">Flot Charts</a> </li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- /.Megamenu -->
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            
                          
                         </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="../logo.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $namapengguna;?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="../logo.png" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php echo $namapengguna;?></h4>
                                        <p class="text-muted">mmazlanh@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                       
                            <li><a href="logout.php?logout=true"><i class="fa fa-power-off"></i> Log Keluar</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div><img src="../logo.png" alt="user-img" class="img-circle"></div>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $namasekolah;?><span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                 
                  <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline fa-fw" data-icon="v"></i> 
                        
                        <span class="hide-menu">Pendaftaran<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="index.php?id=daftar"><i class="fa-fw"></i><span class="hide-menu">Rekod Baru</span></a> </li>
                            
                            
                        </ul>
                    </li>
                       
                    
                    
                    
                    
                    
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline fa-fw" data-icon="v"></i> 
                        
                        <span class="hide-menu">Analisa<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="index.php?id=dg"><i class="fa-fw"></i><span class="hide-menu">Pegawai</span></a> </li>
                            <li> <a href="index.php?id=akp"><i class="fa-fw"></i><span class="hide-menu">AKP</span></a> </li>
                            
                        </ul>
                    </li>
                    
                    
                    
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i> <span class="hide-menu">Laporan<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right"> </span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="index.php?id=status"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Status</span></a></li>
                            
                            <li><a href="index.php?id=pencen"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Pencen</span></a></li>
                         
                            
                        </ul>
                    </li>
                    
     
                        
                    <li class="devider"></li>
                  
                 <li><a href="logout.php?logout=true" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log Keluar</span></a></li>           
                            
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    
                    
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                         </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                        <a href="#" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><?php echo $namapenuh;?></a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#"><?php echo $kodppd;?></a></li>
                            <li class="active"><?php echo $namasekolah;?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                
                
                <div class="row">
<?php       
                     
                     
                     
    if($id=="daftar"){
        
        
         $hari = date('d');
         $bln = date('m');
         $tahunni = date("Y");
         $thnlps = $tahunni - 10;
         $thndpn = $tahunni + 10;   
        
        
        
        
        
     ?>                            
<table border="0" cellpadding="10" cellspacing="0" width="100%" align="center" class="tbl-qa">                           
<form name="frmAdd" action="" method="POST">
<tr class="table-row" >
                              
                              
                              
       <td>BORANG PENDAFTARAN PESARAAN STAF :</td><td>
            
 
 
  <?php 
        $jawatan='';$gred='';$jenissara='';
    
    ?>      
 
         
         
 <tr class="table-row" >
    <td>No Kad Pengenalan <br>
        <input type="text"  maxlength="12" size="40" name="NOKP"  class="txtField" required > Contoh: 123456014321</td>
</tr>
 <tr class="table-row" >
    <td>Nama Penuh Staf:<br>
        <input type="text"  size="70" name="NAMAGURU"  class="txtField" required ></td>
</tr>
<tr class="table-row" >
    <td>Jawatan:<br>
        <input type="text"  size="40" name="JAWATAN"  class="txtField" required ></td>
</tr>
                            
                
<tr class="table-row" >
    <td>Gred Gaji:<br>
    
    
    <select name="GRED" id="GRED">
 <?php
 	$stmt = $auth_user->runQuery("SELECT kod,perkara FROM kodgred");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['kod']; ?>'<?php if ($row['kod']==$gred) { ?>selected<?php } ?>><?php
 echo $row['perkara']; ?></option>

 <?php } ?>
 </select></td></tr>                              
                            
                
<tr class="table-row" >
    <td>Jenis Pesaraan:<br>
    
    
    <select name="JENISBESARA" id="JENISBESARA">
 <?php
 	$stmt = $auth_user->runQuery("SELECT SKALA,PENERANGAN FROM bersara_kodbesara");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['SKALA']; ?>'<?php if ($row['SKALA']==$jenissara) { ?>selected<?php } ?>><?php
 echo $row['PENERANGAN']; ?></option>

 <?php } ?>
 </select></td></tr>  
 <?php
 echo "<tr><td>Tarikh Besara: <br>";
                echo "<select name=\"dari_hari\">";
                                              for ( $counter = 1; $counter <= 31; $counter += 1) {
                                                 echo "<option value=\"$counter\""; if($hari=="$counter") { echo "selected"; } echo ">$counter</option>";
                                              }
                       echo "</select>";
                       echo "<select name=\"dari_bulan\">";
                                              for ( $counter = 1; $counter <= 12; $counter += 1) {
                                                  if($counter=="1") { $bulan = "Jan"; }if($counter=="2") { $bulan = "Feb"; }if($counter=="3") { $bulan = "Mac"; }if($counter=="4") { $bulan = "Apr"; }
                                                  if($counter=="5") { $bulan = "Mei"; }if($counter=="6") { $bulan = "Jun"; }if($counter=="7") { $bulan = "Jul"; }if($counter=="8") { $bulan = "Aug"; }
                                                  if($counter=="9") { $bulan = "Sep"; }if($counter=="10") { $bulan = "Okt"; }if($counter=="11") { $bulan = "Nov"; }if($counter=="12") { $bulan = "Dis"; }
                                                  echo "<option value=\"$counter\"";if($bln==$counter) {echo " selected";} echo">$bulan</option>";
                                              }
                       echo "</select>";

                       echo "<select name=\"dari_tahun\">";
                                         for ( $counter = $thnlps; $counter <= $tahunni; $counter += 1) {
                                            echo "<option value=\"$counter\"";if($tahunni==$counter) {echo " selected";} echo">$counter</option>";
                                         }
                         echo "<option value=\"$thndpn\">$thndpn</option>";
                        echo " </select>";                    
                    
                    
                    
  ?>                  
                    
                    
                    
  <tr class="table-row" ><td><br>
<?php echo "<input type=\"hidden\" name=\"KODPPD\" value=\"$kodppd\" />";?>      
<?php echo "<input type=\"hidden\" name=\"KODSEKOLAH\" value=\"$namapengguna\" />";?>
<input name="save_record" type="submit" value="Simpan" class="demo-form-submit">
</td></tr>

</table>  
    
    </form>       
        
        
        
   <?php     
        
        
    }                 
                     
                     
              
                     
                     
                     
                     
                     
                     
                     
    if($id=="dg"){
        
       ?> 
        
               
     <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Analisa DG</h3>
                            <p class="text-muted m-b-20">Pecahan Mengikut Gred DG32 Hingga DG52</p>
                            
    <?php                          
  

$sql = "SELECT
                     
bersara_nama.KODSEKOLAH,bersara_nama.KODPPD,tssekolah.NAMASEKOLAH,
sum(case when bersara_nama.GRED='DG32' then 1 else 0 END) as DG32,

sum(case when bersara_nama.GRED='DG44 (KUP)' then 1 else 0 END) as DG44KUP,
sum(case when bersara_nama.GRED='DG32 (KUP)' then 1 else 0 END) as DG32KUP,
sum(case when bersara_nama.GRED='DG34' then 1 else 0 END) as DG34,
Sum(case when bersara_nama.GRED='DG34 (KUP)' then 1 else 0 END) as DG34KUP,
sum(case when bersara_nama.GRED='DG38' then 1 else 0 END) as DG38,
sum(case when bersara_nama.GRED='DG44' then 1 else 0 END) as DG44,
sum(case when bersara_nama.GRED='DG44 (KUP)' then 1 else 0 END) as DG44KUP,
sum(case when bersara_nama.GRED='DG48' then 1 else 0 END) as DG48,
sum(case when bersara_nama.GRED='DG48 (KUP)' then 1 else 0 END) as DG48KUP,

sum(case when bersara_nama.GRED='DG52' then 1 else 0 END) as DG52,
sum(case when bersara_nama.GRED='DG52 (KUP)' then 1 else 0 END) as DG52KUP,
sum(case when bersara_nama.GRED='DG54' then 1 else 0 END) as DG54,
sum(case when bersara_nama.GRED='DG54 (KUP)' then 1 else 0 END) as DG54KUP


from bersara_nama
JOIN tssekolah
ON bersara_nama.KODSEKOLAH = tssekolah.KODSEKOLAH

WHERE bersara_nama.KODSEKOLAH=:namapengguna 

GROUP BY bersara_nama.KODSEKOLAH ORDER BY bersara_nama.KODSEKOLAH ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
    ?>                                           
                            
                            
                            
                            <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">NAMA SEKOLAH</th>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="1">DG32</th>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">DG32KUP</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">
                                            <abbr title="Rotten Tomato Rating">DG34</abbr>
                                        </th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">DG34KUP</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">DG38</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">DG44</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">DG44KUP</th>
                                         <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8">DG48</th>
                                         <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9">DG48KUP</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="10">DG52</th>
                                         <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="11">DG52KUP</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="12">DG54</th>
                                         <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="13">DG54KUP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                             
    <?php
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $row) {

                        
                        $dg32=$row['DG32'];
                        $dg32kup=$row['DG32KUP'];
                        $dg34=$row['DG34'];
                        $dg34kup=$row['DG34KUP'];
                        $dg38=$row['DG38'];
                        $dg44=$row['DG44'];
                        $dg44kup=$row['DG44KUP'];
    
                        $dg48=$row['DG48'];
                        $dg48kup=$row['DG48KUP'];
                        $dg52=$row['DG52'];
                        $dg52kup=$row['DG52KUP'];
                        $dg54=$row['DG54'];
                        $dg54kup=$row['DG54KUP'];
                        $kodsekolah=$row['KODSEKOLAH'];
                        $namasekolah=$row['NAMASEKOLAH'];
                        $bil++;
                        
			?>                                 
                                    
                                    
                                    
                                    <tr>
                                        <td class="title"><a href="javascript:void(0)"><?php echo $namasekolah;?></a></td>
                                            <td><?php echo $dg32;?></td>
                                            <td><?php echo $dg32kup;?></td>
                                            <td><?php echo $dg34;?></td>
                                            <td><?php echo $dg34kup;?></td>
                                            <td><?php echo $dg38;?></td>
                                            <td><?php echo $dg44;?></td>
                                            <td><?php echo $dg44kup;?></td>
                                            <td><?php echo $dg48;?></td>
                                            <td><?php echo $dg48kup;?></td>
                                            <td><?php echo $dg52;?></td>
                                            <td><?php echo $dg52kup;?></td>
                                            <td><?php echo $dg54;?></td>
                                            <td><?php echo $dg54kup;?></td>
                                    </tr>
                                  
                    <?php }
}
    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    

                
                    
  <?php 
    } 
                     
 
                     
      
    if($id=="akp"){
        
       ?> 
        
               
     <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Analisa AKP</h3>
                            <p class="text-muted m-b-20">Pecahan Mengikut Gred </p>
                            
    <?php                          
  

$sql = "SELECT
                     
bersara_nama.KODSEKOLAH,bersara_nama.KODPPD,tssekolah.NAMASEKOLAH,
sum(case when bersara_nama.GRED='C17' then 1 else 0 END) as C17,

sum(case when bersara_nama.GRED='C22' then 1 else 0 END) as C22,
sum(case when bersara_nama.GRED='H11' then 1 else 0 END) as H11,
sum(case when bersara_nama.GRED='N11 (KUP)' then 1 else 0 END) as N11KUP,
sum(case when bersara_nama.GRED='N11' then 1 else 0 END) as N11,
sum(case when bersara_nama.GRED='N17' then 1 else 0 END) as N17,
sum(case when bersara_nama.GRED='N19' then 1 else 0 END) as N19,
sum(case when bersara_nama.GRED='N22' then 1 else 0 END) as N22,
sum(case when bersara_nama.GRED='N26' then 1 else 0 END) as N26

from bersara_nama
JOIN tssekolah
ON bersara_nama.KODSEKOLAH = tssekolah.KODSEKOLAH

WHERE bersara_nama.KODSEKOLAH=:namapengguna 

GROUP BY bersara_nama.KODSEKOLAH ORDER BY bersara_nama.KODSEKOLAH ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
    ?>                                           
                            
                            
                            
                            <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">NAMA SEKOLAH</th>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="1">C17</th>
                                        
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">C22</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">
                                            <abbr title="Rotten Tomato Rating">H11</abbr>
                                        </th>
                                       <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">N11</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">N11KUP</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">N17</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">N19</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8">N22</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9">C26</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                             
    <?php
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $row) {

                        
                        $c17=$row['C17'];
                        $c22=$row['C22'];
                        $h11=$row['H11'];
                        $n11=$row['N11'];
                        $n11kup=$row['N11KUP'];
                        $n17=$row['N17'];
                        $n19=$row['N19'];
                        $n22=$row['N22'];
                        $n26=$row['N26'];
    
                        $kodsekolah=$row['KODSEKOLAH'];
                        $namasekolah=$row['NAMASEKOLAH'];
                        $bil++;
                        
			?>                                 
                                    
                                    
                                    
                                    <tr>
                                        <td class="title"><a href="javascript:void(0)"><?php echo $namasekolah;?></a></td>
                                            <td><?php echo $c17;?></td>
                                            <td><?php echo $c22;?></td>
                                            <td><?php echo $h11;?></td>
                                        
                                            <td><?php echo $n11;?></td>
                                            <td><?php echo $n11kup;?></td>
                                            <td><?php echo $n17;?></td>
                                            <td><?php echo $n19;?></td>
                                        <td><?php echo $n22;?></td>
                                        <td><?php echo $n26;?></td>
                                           
                                    </tr>
                                  
                    <?php }
}
    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    

                
                    
  <?php 
    }                     
                     
                     
    if($id=="pencen"){
        
       ?>                    
<div class="col-sm-12">
                        <div class="white-box">
  <?php                          
 

$sql = "SELECT
bersara_nama.NOKP,bersara_nama.ID,
bersara_nama.NAMAGURU,
bersara_nama.JAWATAN,
bersara_nama.GRED,
bersara_nama.KODPPD,
bersara_nama.TAHUN,
bersara_nama.`STATUS`,
bersara_nama.TARIKHSTATUS,
bersara_nama.TARIKHBESARA,
bersara_nama.JENISBESARA,
bersara_nama.S1,
bersara_nama.TARIKHS1,
bersara_nama.S2,
bersara_nama.TARIKHS2,
bersara_nama.S3,
bersara_nama.TARIKHS3,
bersara_nama.S4,
bersara_nama.TARIKHS4,
bersara_nama.CATATAN,
bersara_nama.CATATANSEKOLAH,
tssekolah.NAMASEKOLAH
FROM
bersara_nama
JOIN tssekolah
ON bersara_nama.KODSEKOLAH = tssekolah.KODSEKOLAH


WHERE bersara_nama.KODSEKOLAH=:namapengguna  ORDER BY bersara_nama.NAMAGURU ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
    ?>                          
                            

                            <h3 class="box-title m-b-0">Data Export</h3>
                            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nokp</th>
                                            <th>Nama</th>
                                            
                                            <th>Tarikh Besara</th>
                                            <th>Bil Hari</th>
                                            <th>Jenis Besara</th>
                                            <th>Padam</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                              <th>Nokp</th>
                                            <th>Nama</th>
                                          
                                            <th>Tarikh Besara</th>
                                            <th>Bil Hari</th>
                                            <th>Jenis Besara</th>
                                            <th>Padam</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
 <?php
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $row) {

                        $id=$row['ID'];
                        $nama=$row['NAMAGURU'];
                        $nokp=$row['NOKP'];
                        $namasekolah=$row['NAMASEKOLAH'];
                        $jenisbesara=$row['JENISBESARA'];
    
//----------------------- untuk kiraan tempoh selepas mohon / disahkan ------------------------------------
                       $tarikh = $row['TARIKHBESARA'];
                       if($tarikh=="0000-00-00") { $tarikh= ""; }
                       if($tarikh!="") { $tarikh = date('d/m/Y',strtotime($tarikh)); }
                        
                        
                       $tarikhbesara = $row['TARIKHBESARA'];
                       if( $tarikhbesara =="0000-00-00") {  $tarikhbesara = ""; }
                       if( $tarikhbesara !="") {  $tarikhbesara  = date('d/m/Y',strtotime( $tarikhbesara )); }

$today = date('d F Y',strtotime("now"));
                        $today = date("Y-m-d");
                        $tarikhm = $row['TARIKHBESARA'];
						//$tarikhl = $row['tarikh_lulus'];
    
    
$datetime1 = date_create($tarikhm);
$datetime2 = date_create($today);
$interval = date_diff($datetime1, $datetime2);
$kira= $interval->format('%a');						
					
// ---------------------------------------------------------------------------------------------------------                         
                        
                        $bil++;
                        
			?>                                       
                                        
                                        
                                        
                                        <tr>
                                            <td><?php echo $nokp;?></td>
                                            <td><?php echo $nama;?></td>
                                            
                                            <td><?php echo $tarikhbesara;?></td>
                                            <td><?php echo $kira;?></td>
                                            <td><?php echo $jenisbesara;?></td>
                                            
                                            <!-- action -->
				<td class="table-row" colspan="2"><a href="kemaskini.php?id=<?php echo $row["ID"]; ?>" class="link"><img title="Kemaskini" src="../icon/edit.png"/>
                    </a> <a href="delete.php?ID=<?php echo $row["ID"]; ?>" class="link"><img name="delete" id="delete" title="Padam" onclick="return confirm('Anda Pasti Hendak Padam Rekod Ini?')" src="../icon/delete.png"/></a></td>
                                        </tr>
                         <?php
}
}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
         
                    
                    
     <?php }
                   
                    
                    
                    
                    
    if($id=="status"){
        
       ?>                    
<div class="col-sm-12">
                        <div class="white-box">
  <?php                          
 

$sql = "SELECT
bersara_nama.NOKP,bersara_nama.ID,
bersara_nama.NAMAGURU,
bersara_nama.JAWATAN,
bersara_nama.GRED,
bersara_nama.KODPPD,
bersara_nama.TAHUN,
bersara_nama.`STATUS`,
bersara_nama.TARIKHSTATUS,
bersara_nama.TARIKHBESARA,
bersara_nama.JENISBESARA,
bersara_nama.S1,
bersara_nama.TARIKHS1,
bersara_nama.S2,
bersara_nama.TARIKHS2,
bersara_nama.S3,
bersara_nama.TARIKHS3,
bersara_nama.S4,
bersara_nama.TARIKHS4,
bersara_nama.CATATAN,
bersara_nama.CATATANSEKOLAH,
tssekolah.NAMASEKOLAH
FROM
bersara_nama
JOIN tssekolah
ON bersara_nama.KODSEKOLAH = tssekolah.KODSEKOLAH


WHERE bersara_nama.KODSEKOLAH=:namapengguna  ORDER BY bersara_nama.NAMAGURU ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
    ?>                          
                            

                            <h3 class="box-title m-b-0">STATUS PROSES MAKLUMAT PENCEN</h3>
                            <p class="text-muted m-b-30">Eksport data Ke Copy, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           
<th>Maklumat Staf</th>
<th>Tahun Besara</th>
<th>Penyediaan Kew <br>8 Persaraan <br><i>Tindakan sekolah </th>
<th>Kelulusan Kew 8<br> persaraan <br><i>Tindakan PPD</i></th>
<th>Penghantaran Kew 8<br> yang telah diluluskan <br>beserta borang SG 20 
<br><i>Tindakan Sekolah</i></th>
<th>Penghantaran Kew 8<br> Dan Borang <br>SG 20 Ke AG 
    <br><i>Tindakan Kewangan</i></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
 <?php
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $row) {

                        $kod=$row['ID'];
                        $nama=$row['NAMAGURU'];
                        $nokp=$row['NOKP'];
                        $namasekolah=$row['NAMASEKOLAH'];
                        $jenisbesara=$row['JENISBESARA'];
    
    
       $s1=$row['S1'];
       $s2=$row['S2'];
       $s3=$row['S3'];
       $s4=$row['S4'];
       
       $tarikh1=$row['TARIKHS1'];
       $tarikh2=$row['TARIKHS2'];
       $tarikh3=$row['TARIKHS3'];
       $tarikh4=$row['TARIKHS4'];
    
    if($tarikh1=="0000-00-00") { $tarikh1 = ""; }
     if($tarikh1!="") { $tarikh1 = date('d/m/Y',strtotime($tarikh1)); }
       
   if($tarikh2=="0000-00-00") { $tarikh2 = ""; }
   if($tarikh2!="") { $tarikh2 = date('d/m/Y',strtotime($tarikh2)); }
       
        if($tarikh3=="0000-00-00") { $tarikh3 = ""; }
   if($tarikh3!="") { $tarikh3 = date('d/m/Y',strtotime($tarikh3)); }

 
        if($tarikh4=="0000-00-00") { $tarikh4 = ""; }
   if($tarikh4!="") { $tarikh4 = date('d/m/Y',strtotime($tarikh4)); }
    
    
//----------------------- untuk kiraan tempoh selepas mohon / disahkan ------------------------------------
                       $tarikh = $row['TARIKHBESARA'];
                       if($tarikh=="0000-00-00") { $tarikh= ""; }
                       if($tarikh!="") { $tarikh = date('d/m/Y',strtotime($tarikh)); }
                        
                        
                       $tarikhbesara = $row['TARIKHBESARA'];
                       if( $tarikhbesara =="0000-00-00") {  $tarikhbesara = ""; }
                       if( $tarikhbesara !="") {  $tarikhbesara  = date('d/m/Y',strtotime( $tarikhbesara )); }

$today = date('d F Y',strtotime("now"));
                        $today = date("Y-m-d");
                        $tarikhm = $row['TARIKHBESARA'];
						//$tarikhl = $row['tarikh_lulus'];
    
    
$datetime1 = date_create($tarikhm);
$datetime2 = date_create($today);
$interval = date_diff($datetime1, $datetime2);
$kira= $interval->format('%a');						
					
// ---------------------------------------------------------------------------------------------------------                         
                        
                        $bil++;
                        
			?>                                       
                                        
                                        
                                        
                                        <tr>
                                           
                                            <td><?php echo "$nama<br>$nokp";?></td>
                                            <td><?php echo "$tarikhbesara";?></td>
                                             <td>
   <?php
   if($s1=='1'){
   echo"
     <a href=\"../modulsekolah/pengesahan1sk.php?id=$kod\" title=\"Tindkan Sekolah [ $id ]$nama \"> 
     <span class=\"label label-success\">Sudah Selesai</span></a><br><i>$tarikh1</i> </td>";
   }
   if($s1==''){
   echo"
  <a href=\"../modulsekolah/pengesahan1sk.php?id=$kod\" title=\"Tindkan Sekolah [ $id ]$nama \"> 
   
   <span class=\"label label-danger\">Belum Selesai</span></a> </td>";
   }    
   ?> 
                                            
                                            <td><?php
                                                 if($s2==''){
   echo"
   
   <span class=\"label label-danger\">Belum Selesai</span><br><i>$tarikh2</i> </td>";
   }  
    
    if($s2=='1'){
   echo"
   
   <span class=\"label label-success\">Sudah Selesai</span><br><i>$tarikh2</i>";
   }
  ?>   
 </td>
 <td>
     
 <?php
     if($s3==''){
   echo"
   <a href=\"../modulsekolah/pengesahan3sk.php?id=$kod\" title=\"Tindkan Sekolah [ $id ]$nama \"> 
   <span class=\"label label-danger\">Belum Selesai</span></a><br><i>$tarikh3</i> </td>";
   }  
    if($s3=='1'){
   echo"
   <a href=\"../modulsekolah/pengesahan3sk.php?id=$kod\" title=\"Tindkan Sekolah [ $id ]$nama \"> 
   <span class=\"label label-success\">Sudah Selesai</span></a><br><i>$tarikh3</i> </td>";
   }
     ?>
</td>
<td>
 <?php
    if($s4==''){
   echo"
   
   <span class=\"label label-danger\">Belum Selesai</span><br><i>$tarikh4</i> </td>";
   } 
       
    if($s4=='1'){
   echo"
 
   <span class=\"label label-success\">Sudah Selesai</span><br><i>$tarikh4</i> </td>";
   }   
    ?>
                                            </td>
                                        </tr>
                         <?php
}
}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
         
                    
                    
     <?php }
                     
   
                     ?>
                                    
                    
                    
                    
                    
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme working">12</a></li>
                            </ul>
                            <ul class="m-t-20 all-demos">
                                <li><b>Choose other demos</b></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                               
                               
                            </ul>
                        </div>
                    </div>
                </div>
                
                
     <?php }
                
                
         else
     {
         
     header("Location: ../modulppd/logout.php?logout=true");     
         
     }         
                
                
                
                ?>           
                
                
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; Pejabat Pendidikan Daerah Kluang</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
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
    
   <!-- jQuery peity -->
    <script src="../plugins/bower_components/tablesaw-master/dist/tablesaw.js"></script>
    <script src="../plugins/bower_components/tablesaw-master/dist/tablesaw-init.js"></script>
    <!--Style Switcher --> 
    
    
    
    
    
    
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
