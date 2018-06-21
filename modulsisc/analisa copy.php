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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


<![endif]-->
</head>
<style>

.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
    </style>
<style>    
.accordion {
        background-color: white;
        color: #444;
        cursor: pointer;
        padding: 10px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
}

.active, .accordion:hover {
        background-color: ;
}

.panel {
        padding: 0 11px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
}
</style>
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
                    <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Menu SISC+</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Perihal</li>
                                    <li><a href="#">SISC+ KPM</a></li>
                                  
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Bantuan</li>
                                    <li><a href="#">mmazlanh@gmail.com</a><br>019-7771154</li>
                                  
                                </ul>
                            </li>
                         
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Manual</li>
                                    <li> <a href="#">SIP</a> </li>
                                    
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
                                        <p class="text-muted">mmazlanh@gmail.com</p><a href="#" class="btn btn-rounded btn-danger btn-sm"><?php echo $namapenuh;?></a></div>
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
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $namapenuh;?><span class="caret"></span></a>
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
                       
                      <li> <a href="#" class="waves-effect"><i class="mdi mdi-format-color-fill fa-fw"></i> <span class="hide-menu">Laporan<span class="fa arrow"></span> </a>
                        <ul class="nav nav-second-level">
                            
                            <li><a href="index.php?id=senaraiguru"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Senarai Guru </span></a></li>
                            <li><a href="index.php?id=kedatangan"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Kedatangan</span></a></li>
                         
                         
                            
                        </ul>
                    </li>
                     
                    
                    
                    
                    
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline fa-fw" data-icon="v"></i> 
                        
                        <span class="hide-menu">Analisa<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="analisa.php?id=jenis"><i class="fa-fw"></i><span class="hide-menu">Jenis Bimbingan</span></a> </li>
                           <li> <a href="analisa.php?id=tovar"><i class="fa-fw"></i><span class="hide-menu">Kekerapan</span></a> </li>
                            
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
                        
                            <li><a href="#"><?php echo $namapengguna;?></a></li>
                            <li class="active"><?php echo $namappd;?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                
                
                <div class="row">
<?php       
                     
                     
             
  if($id=="tovar"){
      
    $bil=0;

$stmt3 = $auth_user->runQuery("SELECT * FROM sisc_guru WHERE SISC='$namapengguna' ORDER BY NAMAGURU ASC");
$stmt3->execute();
foreach ($stmt3 as $row) {
$nokp= $row['NOKP'];
$nama=$row['NAMAGURU'];

    

$max = $auth_user->runQuery("SELECT * FROM sisc_guru_data WHERE NOKP=:nokp and JENISBIMBINGAN='PENILAIAN AKHIR'");
$max->bindParam(':nokp',$nokp);    
$max->execute();
$maxRow=$max->fetch(PDO::FETCH_ASSOC);
$maxs421=$maxRow['S421']*10/4;
$maxs411=$maxRow['S411']*10/4;
$maxs422=$maxRow['S422']*5/4;    
$maxs431=$maxRow['S431']*15/4; 
$maxs441=$maxRow['S441']*25/4;    
$maxs442=$maxRow['S442']*5/4; 
$maxs451=$maxRow['S451']*10/4;    
$maxs461=$maxRow['S461']*20/4;
 $jumlahwajaran=$maxs411+$maxs421+$maxs422+$maxs431+$maxs441+$maxs442+$maxs451+$maxs461;   
    
                     $bil++;
    
 //-------------------- Kira Jenis Bimbingan --------------------   
$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'DTP' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kiradtp = $stmt->fetchColumn();
    
$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'PRIME' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kiraprime = $stmt->fetchColumn();     

$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'TS25' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kirats25 = $stmt->fetchColumn(); 

$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'KELOMPOK' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kirakelompok = $stmt->fetchColumn(); 
 //-------------------- Tamat Jenis Bimbingan --------------------  
    
    
 $sqln = $auth_user->runQuery("SELECT * FROM tkppd WHERE KODPPD=:kodppd");
	$sqln->execute(array(":kodppd"=>$kodppd));
    $sqlnRow=$sqln->fetch(PDO::FETCH_ASSOC);
    $namappd=$sqlnRow['NAMAPPD'];    
    
    

?>
<?$tov = 50?>
<a role="button" class="accordion col-sm-12">
        <table style="width:100%;">
            <tr>
                <td style="width:10%;" rowspan="2"><? echo $nokp?></td>
                <td style="width:27%;" rowspan="2"><? echo $nama?></td>
                <td style="width:5%;" rowspan="2"><strong>TOV : </strong></td>
                <td style="width:5%;" rowspan="2"><?echo $tov?></td>
                <td rowspan="2"><strong>Wajaran : </strong></td>
                <? $beza = $jumlahwajaran-$tov; if($beza > 0){$beza = '+'.$beza;}
                if ($jumlahwajaran>=$tov) { echo'
                    <td style="width:14%;" rowspan="2">'.$jumlahwajaran.'% <span class="text-success"><i class="fa fa-arrow-up"></i>'.$beza.'%</span></td>';}
                else { echo'
                    <td style="width:14%;" rowspan="2">'.$jumlahwajaran.'% <span class="text-danger"><i class="fa fa-arrow-down"></i>'.$beza.'%</span></td>';} ?>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.1.1</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.2.1</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.2.2</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.3.1</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.4.1</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.4.2</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.5.1</td>
                <td style="width:4%;border: 1px solid black;text-align:center;background-color:#DCDCDC;">4.6.1</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs411?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs421?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs422?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs431?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs441?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs442?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs451?></td>
                <td style="border: 1px solid black;text-align:center;"><? echo $maxs461?></td>
            </tr>
        </table>
</a>
<div class="panel">

    <table border="1" width="100%">
        <tr><td colspan="10" style="background-color:#DCDCDC;"> <center><b>Standard</b></center></td></tr>
        <tr><td><center><b>BILANGAN <br>JENIS BIMBINGAN</b></center></td>
            <td><center><b> TARIKH <br>BIMBINGAN</b></center></td>
            <td><center><b>4.1.1 <br>(10)</b></center></td><td><center><b>4.2.1<br>(10) </b></center></td>
            <td><center><b>4.2.2<br>(5)</b></center></td><td><center><b>4.3.1<br>(15)</b></center></td>
            <td><center><b>4.4.1<br>(25) </b></center></td><td><center><b>4.4.2 <br>(5)</b></center></td>
            <td><center><b>4.5.1<br>(10)</b></center></td><td><center><b>4.6.1 <br>(20)</b></center></td>
        </tr>   
    
   
<?php
   
$stmt3 = $auth_user->runQuery("SELECT * FROM sisc_guru_data WHERE NOKP='$nokp' ORDER BY BILKE ASC");
$stmt3->execute();
foreach ($stmt3 as $sqlnRow) {

    $jenis=$sqlnRow['JENISBIMBINGAN']; 
    $catatan=$sqlnRow['CATATAN1'];
    $s411=$sqlnRow['S411']; 
    $s421=$sqlnRow['S421'];
    $s422=$sqlnRow['S422'];
    $s431=$sqlnRow['S431'];
    $s441=$sqlnRow['S441']; 
    $s442=$sqlnRow['S442']; 
    $s451=$sqlnRow['S451'];
    $s461=$sqlnRow['S461'];     
    
    $bilke=$sqlnRow['BILKE'];
    $pp1 = $sqlnRow['PP1'];
    
    if($s411 == 0) {$s411 = '';}
     if($s421 == 0) {$s421 = '';}
     if($s422 == 0) {$s422 = '';}
     if($s431 == 0) {$s431 = '';}
     if($s441 == 0) {$s441 = '';}
     if($s442 == 0) {$s442 = '';}
     if($s451 == 0) {$s451 = '';}
     if($s461 == 0) {$s461 = '';}
    
                       if($pp1=="0000-00-00") { $pp1= ""; }
                       if($pp1!="") { $pp1 = date('d/m/Y',strtotime($pp1)); }
    
?>



        
    <tr>
       
        <td >
   <?php echo "$bilke-$jenis";?>
  <div class="tooltip"> xxxx          
  <span class="tooltiptext">Tooltip text</span>
</div>
      </td> 
        <td><center>  <?php echo "$pp1";?></center>
           
        
        </td>

        
    
        <td><center><?php echo $s411;?></center></td>
        
        
        <td><center><?php echo $s421;?></center></td>
        <td><center><?php echo $s422;?></center></td>
        <td><center><?php echo $s431;?></center></td>
        <td><center><?php echo $s441;?></center></td>
        <td><center><?php echo $s442;?></center></td>
         <td><center><?php echo $s451;?></center></td>
        <td><center><?php echo $s461;?></center></td>
        
        </tr>
    
 
<?php
        
    
   
  }
   
    
    ?>
 
        
        <tr><td colspan=2><Center> <b>WAJARAN (%)</b></Center></td><td><center><b> <? echo $maxs411; ?></b></center></td><td><center><b> <? echo $maxs421; ?></b></center></td> <td> <center><b><? echo $maxs422; ?></b></center></td> <td><center><b> <? echo $maxs431; ?></b></center></td> 
            <td><center><b> <? echo $maxs441; ?></b></center></td> <td><center><b> <? echo $maxs442; ?></b></center></td> <td><center><b> <? echo $maxs451; ?></b></center></td> <td><center><b> <? echo $maxs461; ?></b></center></td> 
        </tr>
        <tr><td colspan=2><Center> <b>JUMLAH WAJARAN (%) </b></Center></td><td colspan=8> <center><b> <? echo $jumlahwajaran; ?></b></center></td>  </tr>
  </table> 
    
    
    

</div>

                    
                    
<?php  } 
  
      
      
      
      
      
      
      
      
  }
                     
                     
              
  if($id=="jenis"){
      
     
       ?>                    
<div class="col-sm-12">
                        <div class="white-box">
  <?php                          
 

$sql = "SELECT
users.user_name,
users.real_name,
sisc_guru.SISC,
sisc_guru.NOKP,sisc_guru.ID,
sisc_guru.NAMAGURU,
sisc_guru.KODSEKOLAH,
sisc_guru.JAWATAN,
sisc_guru.KODPPD,
sisc_guru.TAHUN,
tssekolah.NAMASEKOLAH
FROM
users
JOIN sisc_guru
ON users.user_name = sisc_guru.SISC 
JOIN tssekolah
ON sisc_guru.kodsekolah = tssekolah.KODSEKOLAH


WHERE sisc_guru.SISC=:namapengguna  ORDER BY sisc_guru.NAMAGURU ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
      
      

    
      
      
      
    ?>                          
                            

                            <h3 class="box-title m-b-0">Analisa Jenis Kekerapan Guru Yang Dibimbing</h3>
                            <p class="text-muted m-b-30">Eksport data Ke Salin, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            
                                            <th>Nama Guru Dibimbing</th>
                                            <th>Nama Sekolah</th>
                                            <th>DTP</th>
                                            <th>INDIVIDU</th>
                                            <th>TS25</th>
                                            <th>KELOMPOK</th>
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

                        $id=$row['ID'];
                        $nama=$row['NAMAGURU'];
                        $nokp=$row['NOKP'];
                        $namasekolah=$row['NAMASEKOLAH'];
                       
    
           
                        $bil++;
    
 //-------------------- Kira Jenis Bimbingan --------------------   
$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'DTP' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kiradtp = $stmt->fetchColumn();
    
$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'INDIVIDU' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kiraprime = $stmt->fetchColumn();     

$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'TS25' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kirats25 = $stmt->fetchColumn(); 

$stmt = $auth_user->runQuery("SELECT count(*) FROM sisc_guru_data WHERE JENISBIMBINGAN = 'KELOMPOK' AND NOKP='$nokp' ");
$stmt->execute([':nokp','$nokp']);
$kirakelompok = $stmt->fetchColumn(); 
 //-------------------- Tamat Jenis Bimbingan --------------------                          
			?>                                       
                                        
                                        
                                        
                                        <tr>
                                            
                                            <td><?php echo "
                                            <a href=\"../modulsisc/pelaporan.php?id=$id\" title=\"Pepaloran[ $id ]$nama \"> 
                                            $nama</a>";?>
                                            
                                            </td>
                                            <td><?php echo $namasekolah;?></td>
                                            <td><?php echo $kiradtp;?> </td>
                                            <td><?php echo $kiraprime;?> </td>
                                            <td><?php echo $kirats25;?> </td>
                                            <td><?php echo $kirakelompok;?> </td>
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
                    
         
                    
                    
     <?php     
     
      
  }                   
                    

                     ?>
                                    
                    
                    
                    
                    
                </div>
                
  
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Manual<span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>1. TOV/AR1</b></li>
                                <li> Pemantuan Dalam Kelas, Pencerapan Pertama Tahun Semasa </li>
                               
                            </ul>
                            <ul class="m-t-20 all-demos">
                                <li><b>2. Manual 2</b></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>3. Manual 3</b></li>
                               
                               
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
            <footer class="footer text-center"> 2018 &copy; Bahagian Sekolah Harian Kementerian Pendidikan Malaysia</footer>
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
    
    
    
 <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}
</script>   
    
    
    
</body>

</html>
