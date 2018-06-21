<?php

	@require_once("../modul/session.php");
	require_once("../modul/class.user.php");
	$auth_user = new USER();

	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
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



    $sqln = $auth_user->runQuery("SELECT * FROM tkppd  WHERE KODPPD=:kodppd");
	$sqln->execute(array(":kodppd"=>$kodppd));
    $sqlnRow=$sqln->fetch(PDO::FETCH_ASSOC);
    $namappd=$sqlnRow['NAMAPPD'];



 @$id= $_GET['id'];

if($userlevel=="15"){

if(!empty($_POST["save_record"])) {
	
        $nokp=$_POST['NOKP'];
        $namaguru=$_POST['NAMAGURU'];		
	    $kodppd=$_POST['KODPPD'];
        $kodsekolah=$_POST['KODSEKOLAH'];
        $sisc=$_POST['SISC'];
        $jenisbimbingan=$_POST['JENISBIMBINGAN'];
        $catatan1=$_POST['CATATAN1'];
     
    $s411=$_POST['S411'];
    $s421=$_POST['S421'];
    $s422=$_POST['S422'];
    $s431=$_POST['S431'];
    $s441=$_POST['S441'];
    $s442=$_POST['S442'];
    $s451=$_POST['S451'];
    $s461=$_POST['S461'];
    
    $f411=$_POST['f411'];
    $f421=$_POST['f421'];
    $f422=$_POST['f422'];
    $f431=$_POST['f431'];
    $f441=$_POST['f441'];
    $f442=$_POST['f442'];
    $f451=$_POST['f451'];
    $f461=$_POST['f461'];
    
    if($jenisbimbingan <> 'PENILAIAN AKHIR') {
        if($f411 == 99) {$s411 = 99;}
        if($f421 == 99) {$s421 = 99;}
        if($f422 == 99) {$s422 = 99;}
        if($f431 == 99) {$s431 = 99;}
        if($f441 == 99) {$s441 = 99;}
        if($f442 == 99) {$s442 = 99;}
        if($f451 == 99) {$s451 = 99;}
        if($f461 == 99) {$s461 = 99;}
    }
    
        $bilkeb=$_POST['BILKE'];
    
  
   $tahunx = date('Y'); 
    
    
	//--------------------------- carian untuk nokp yg dah didaftarkan --------------	
	$admin =  $auth_user->runQuery("SELECT * FROM sisc_guru_data  WHERE NOKP= :nokp AND BILKE=:bilke AND SISC=:sisc AND YEAR(PP1)=:tahunx");
        
    $admin->bindParam(':nokp',$nokp);
    $admin->bindParam(':bilke',$bilke);
    $admin->bindParam(':sisc',$sisc);
    $admin->bindParam(':tahunx',$tahunx);
    
    
	$admin->execute();
	$kira = $admin->rowCount();
	if($kira > 0){
		$userRow=$admin->fetch(PDO::FETCH_ASSOC);
        $namaguru=$userRow['NAMAGURU'];
		$nokp=$userRow['NOKP'];
         
    $tarikhy=$userRow['PP1'];
    
    
    
$tarikhx=date('d M Y',strtotime($tarikhy));
 
        

	
        
        
		
     echo "<script>alert('Laporan Ke $bilke telah dihantar, sila buat semakan.');</script>";
	}else{		
        
        
   
       // $kelas = strtoupper($kelas);
 
        
		$sql =  $auth_user->runQuery("INSERT INTO sisc_guru_data (NOKP,NAMAGURU,KODPPD,KODSEKOLAH,SISC,PP1,JENISBIMBINGAN,CATATAN1,BILKE,
        S411,S421,S422,S431,S441,S442,S451,S461,TAHUN,KODNEGERI) 
        VALUES (:1, :2, :3, :4,:5,:6,:7,:8,:9,
        :10,:11,:12,:13,:14,:15,:16,:17,:18,:19)"); 
        
  
		$sql->bindParam(':1',$nokp);
		$sql->bindParam(':2',$namaguru);
		$sql->bindParam(':3',$kodppd);
		$sql->bindParam(':4',$kodsekolah);
        $sql->bindParam(':5',$sisc);
        $sql->bindParam(':6',$tarikhmula);
        $sql->bindParam(':7',$jenisbimbingan);
        $sql->bindParam(':8',$catatan1);
        $sql->bindParam(':9',$bilkeb);
        $sql->bindParam(':10',$s411);
        $sql->bindParam(':11',$s421);
        $sql->bindParam(':12',$s422);
        $sql->bindParam(':13',$s431);
        $sql->bindParam(':14',$s441);
        $sql->bindParam(':15',$s442);
        $sql->bindParam(':16',$s451);
        $sql->bindParam(':17',$s461);
        $sql->bindParam(':18',$tahunsemasa);
       
        $sql->bindParam(':19',$kodnegeri);
        
        
        
        
           $dari_hari = $_POST['dari_hari'];
           $dari_bulan = $_POST['dari_bulan'];
           $dari_tahun = $_POST['dari_tahun'];
           

           $tarikhmula = $dari_tahun."-".$dari_bulan."-".$dari_hari;  
    
          $tahunsemasa = date('Y'); 
        
        
		
		if($sql->execute()) {
			$success_message = "Added Successfully";
            
            header("Location: analisa.php?id=tovar");
                    
		} else {
			$error_message = "Rekod Tidak Berjaya disimpan";
		}

	} 
}
    
  
    
 
$id=isset($_GET['id']) ? $_GET['id'] : null;  

$pdo_statement=$auth_user->runQuery(" 
SELECT
users.user_name,
users.real_name,
sisc_guru.SISC,
sisc_guru.NOKP,sisc_guru.ID,sisc_guru.JENISBIMBINGAN,
sisc_guru.NAMAGURU,
sisc_guru.KODSEKOLAH,
sisc_guru.JAWATAN,
sisc_guru.KODPPD,
sisc_guru.TAHUN,sisc_guru.CATATAN1,
sisc_guru.PP2,sisc_guru.PP3,sisc_guru.PP4,sisc_guru.PP5,
tssekolah.NAMASEKOLAH
FROM
users
JOIN sisc_guru
ON users.user_name = sisc_guru.SISC 
JOIN tssekolah
ON sisc_guru.kodsekolah = tssekolah.KODSEKOLAH



 where sisc_guru.ID=:id");

$pdo_statement->bindParam(':id',$id);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

foreach( $result as $row ) {
   $kodsekolah=$row['KODSEKOLAH'];  
   $nokp=$row['NOKP'];
   $namaguru=$row['NAMAGURU'];
   $namasekolah=$row['NAMASEKOLAH']; 
   $catatan1=$row['CATATAN1'];
   $jenisbimbingan=$row['JENISBIMBINGAN'];
   $catatan1=$row['CATATAN1'];
    
   
    
    
    
    
    
    
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
    <title>Sistem Pengurusan Pelaporan SISC & SIP + KPM</title>
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
                    <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs"> </span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                          
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
                                        <p class="text-muted">mmazlanh@gmail.com</p><a href="#" class="btn btn-rounded btn-danger btn-sm"><?php echo $namapenuh;?></a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                           
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
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $namapenuh;?><span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
                           
                            <li><a href="logout.php?logout=true"><i class="fa fa-power-off"></i> Log Keluar</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                 
               
                       
                    
                    
                    
                    
                    
                    
                 
                    
                    
                  
                    
     
                        
                    <li class="devider"></li>
                  
                         
                            
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
                            <li class="active"><?php echo $namappd;?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                
                
                <div class="row">
      
<form name="frmAdd" action="" method="POST">
    
    
    <?php 
    
    $jenisbimbingan="";$s411="";$s421="";$s422="";$s431="";$s441="";$s442="";$s451="";
    $s461="";
    
    $bilke="";
    
         $hari = date('d');
         $bln = date('m');
         $tahunni = date("Y");
         $thnlps = $tahunni - 10;
         $thndpn = $tahunni + 10; 
    
            
$tahunsemasa = date('Y'); 
    ?>
    
<table border="0" cellpadding="10" cellspacing="0" width="80%" align="center" class="tbl-qa">  

    <tr><td colspan="3"><h4>Pelaporan Bimbingan Oleh Pegawai SISC</h4></td></tr>
<tr >
    <td>
        No Kad Pengenalan</td><td>:</td><td> <b><?php echo $nokp;?></b>
    </td>
</tr>
                    
<tr  >
    <td>
        Nama Guru Yang Dibimbing</td><td>: </td><td><b><?php echo $namaguru;?></b>
    </td>
</tr>                    
<tr  >
    <td>
        Nama Sekolah </td><td>: </td><td><b><?php echo $namasekolah;?></b>
    </td>
</tr> 
<tr class="table-row" >
    <td>Bimbingan Yang Ke </td><td>:</td><td>
    
    
    
 <?php
 	$stmt = $auth_user->runQuery("SELECT BILKE FROM sisc_guru_data WHERE NOKP=:nokp ORDER BY BILKE DESC");
    $stmt->bindParam(':nokp',$nokp);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
    $missing = array();
    
    if($stmt->rowCount() <> 0) {
        $diff1 = array();
        while($row2=$stmt->fetch(PDO::FETCH_ASSOC)) {
            $diff1[] = $row2['BILKE'];
        }
        $diff2 = range(1,max($diff1));
        $missing = array_diff($diff2,$diff1);
    }
    
    $bilkeo = $row['BILKE'];
    $bilkeb = $bilkeo+1;
 
 if(count($missing) > 0) {
     echo '<select name="BILKE">';
     foreach($missing as $mis) {
         echo '<option>'.$mis.'</option>';
     }
     echo '<option>'.$bilkeb.'</option>
     </select>
     <b>/'.$tahunsemasa.'</b>
     </td></tr>';
 } else {
     echo '
     <b>'.$bilkeb.'
     <input name="BILKE" id="BILKE" type="hidden" value="'.$bilkeb.'"> /'.$tahunsemasa.'</b>  
    </td></tr> 
     ';
 }
      

echo " <tr><td>Tarikh </td><td>:</td><td>";
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
    
<tr class="table-row" >
    <td>Jenis Bimbingan </td><td>:</td><td>
    
    
    <select name="JENISBIMBINGAN" id="JENISBIMBINGAN">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodbimbingan");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$jenisbimbingan) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select></td></tr> 
   	  
                
            <tr><td>Standard<br>SKPMg2</td><td>:</td><td colspan="3">
    
<table width="100%" border="1">
<tr><td colspan="8"><center><b>Standard </b></center></td></tr>
<tr><td><center><b>4.1.1 </b></center> </td><td><center> <b>4.2.1 </b></center></td><td><center> <b>4.2.2 </b></center></td><td><center> <b>4.3.1 </b></center></td><td><center> <b>4.4.1 </b></center></td>
<td><center> <b>4.4.2 </b></center></td><td><center> <b>4.5.1 </b></center></td><td><center> <b>4.6.1 </b></center></td></tr>
<tr><td colspan="8"><center><b>Fokus</b></center></td></tr>
<tr>
    <input type="hidden" name="f411" value="">
    <input type="hidden" name="f421" value="">
    <input type="hidden" name="f422" value="">
    <input type="hidden" name="f431" value="">
    <input type="hidden" name="f441" value="">
    <input type="hidden" name="f442" value="">
    <input type="hidden" name="f451" value="">
    <input type="hidden" name="f461" value="">
    <td><center><input type="checkbox" name="f411" value="99"></center></td>
    <td><center><input type="checkbox" name="f421" value="99"></center></td>
    <td><center><input type="checkbox" name="f422" value="99"></center></td>
    <td><center><input type="checkbox" name="f431" value="99"></center></td>
    <td><center><input type="checkbox" name="f441" value="99"></center></td>
    <td><center><input type="checkbox" name="f442" value="99"></center></td>
    <td><center><input type="checkbox" name="f451" value="99"></center></td>
    <td><center><input type="checkbox" name="f461" value="99"></center></td>
    
</tr>
<tr><td colspan="8"><center><b>Wajaran</b></center></td></tr>
<tr style="height:40px;">
<td><center>
  <select name="S411" id="S411">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s411) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  
    
    
    </center> </td>
                
<td><center>  <select name="S421" id="S421">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s421) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>   </center>                  
</td><td><center>  <select name="S422" id="S422">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s422) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  </center>
</td><td><center>  <select name="S431" id="S431">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s431) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  </center>
</td><td><center>  <select name="S441" id="S441">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s441) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  </center>
</td><td><center>  <select name="S442" id="S442">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s422) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  </center></td><td><center>
     <select name="S451" id="S451">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s451) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>              
                </center>
</td><td><center>  <select name="S461" id="S461">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodmarkah");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$s461) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>  </center>
</td>
<td>





</td>



</tr>      
</table>  
    
    </tr>
    <tr>
    
    <td>
        Catatan Pegawai</td><td>: </td><td>
        <textarea class="textarea_editor form-control" name ="CATATAN1" rows="3" placeholder=" "></textarea>
    </td>
</tr>             

  <?php  
    
    
  }
    ?>
    
 <tr class="table-row" ><td>
<?php echo "<input type=\"hidden\" name=\"TAHUN\" value=\"$tahunsemasa\" />";?>        
<?php echo "<input type=\"hidden\" name=\"NOKP\" value=\"$nokp\" />";?>     
<?php echo "<input type=\"hidden\" name=\"NAMAGURU\" value=\"$namaguru\" />";?>
<?php echo "<input type=\"hidden\" name=\"KODPPD\" value=\"$kodppd\" />";?> 
<?php echo "<input type=\"hidden\" name=\"KODNEGERI\" value=\"$kodnegeri\" />";?>      
<?php echo "<input type=\"hidden\" name=\"KODSEKOLAH\" value=\"$kodsekolah\" />";?> 
<?php echo "<input type=\"hidden\" name=\"SISC\" value=\"$namapengguna\" />";?> 
     
</td><td></td><td><input name="save_record" type="submit" value="Simpan" 
                         class="demo-form-submit">
     
<a href="../modulsisc/analisa.php?id=tovar" class="demo-form-submit"> <i class="glyphicon glyphicon-fast-backward"></i> &nbsp; Batal</a> 
          </td>
                </tr>

  
                </table>  
    
    </form>       
 
                     
       
                     
   
                    
                    
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> MANUAL<span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                
                                
                                
                            </ul>
                           
                            <ul class="m-t-20 chatonline">
                                <li><b>MANUAL</b></li>
                               
                               
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
            <footer class="footer text-center"> 2018 &copy; Bahagian Pengurusan Sekolah Harian KEMENTERIAN PENDIDIKAN MALAYSIA </footer>
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
