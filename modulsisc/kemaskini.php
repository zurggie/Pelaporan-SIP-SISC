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
	
$markah1=isset($_POST['MARKAH1']) ? $_POST['MARKAH1'] : null;
$tarikhmula=isset($_POST['PP1']) ? $_POST['PP1'] : null; 
$jenisbimbingan=isset($_POST['JENISBIMBINGAN']) ? $_POST['JENISBIMBINGAN'] : null; 
$catatan1=isset($_POST['CATATAN1']) ? $_POST['CATATAN1'] : null;  
$masakemaskini=isset($_POST['MASAKEMASKINI']) ? $_POST['MASAKEMASKINI'] : null;     
$id=isset($_GET['id']) ? $_GET['id'] :null;  
    
    
    
  
           $dari_hari = $_POST['dari_hari'];
           $dari_bulan = $_POST['dari_bulan'];
           $dari_tahun = $_POST['dari_tahun'];
           

           $tarikhmula = $dari_tahun."-".$dari_bulan."-".$dari_hari;  
    
    
    
    
	$pdo_statement=$auth_user->runQuery("update sisc_guru_data set PP1=:tarikhmula,
    CATATAN1=:catatan1,JENISBIMBINGAN=:jenisbimbingan,MASAKEMASKINI=:masakemaskini,
	MARKAH1=:markah1
    
    where ID=:id");
  
    $pdo_statement->bindParam(':markah1',$markah1);
    $pdo_statement->bindParam(':tarikhmula',$tarikhmula); 
    $pdo_statement->bindParam(':catatan1',$catatan1); 
    $pdo_statement->bindParam(':jenisbimbingan',$jenisbimbingan); 
    $pdo_statement->bindParam(':masakemaskini',$masakemaskini); 
    $pdo_statement->bindParam(':id',$id);
	$result = $pdo_statement->execute();
	if($result) {
 header("Location: ../modulsisc/analisa.php?id=tovar");
	}
}
    
if(!empty($_POST["save_record2"])) {
	

$tarikhmula=isset($_POST['PP1']) ? $_POST['PP1'] : null; 

   
$id=isset($_GET['id']) ? $_GET['id'] :null;  
    
    
    
  
           $dari_hari = $_POST['dari_hari'];
           $dari_bulan = $_POST['dari_bulan'];
           $dari_tahun = $_POST['dari_tahun'];
           

           $tarikhmula = '';  
           $jenisbimbingan='';
           $catatan1='';
           $statuskeh='';
    
    
    
    
	$pdo_statement=$auth_user->runQuery("update sisc_guru set PP1=:tarikhmula,CATATAN1=:catatan1,
    JENISBIMBINGAN=:jenisbimbingan,STATUSKEH=:statuskeh
    
    where ID=:id");
  
    $pdo_statement->bindParam(':jenisbimbingan',$jenisbimbingan); 
    $pdo_statement->bindParam(':tarikhmula',$tarikhmula); 
    $pdo_statement->bindParam(':catatan1',$catatan1); 
    $pdo_statement->bindParam(':statuskeh',$statuskeh); 
    
    $pdo_statement->bindParam(':id',$id);
	$result = $pdo_statement->execute();
    
	if($result) {
 header("Location: ../modulsisc/index.php?id=kedatangan");
	}
}    
    
 
$id=isset($_GET['id']) ? $_GET['id'] : null;  

$pdo_statement=$auth_user->runQuery(" 
SELECT
users.user_name,
users.real_name,
sisc_guru_data.SISC,
sisc_guru_data.NOKP,sisc_guru_data.ID,sisc_guru_data.JENISBIMBINGAN,sisc_guru_data.MARKAH1,
sisc_guru_data.NAMAGURU,
sisc_guru_data.KODSEKOLAH,
sisc_guru_data.JAWATAN,
sisc_guru_data.KODPPD,
sisc_guru_data.TAHUN,sisc_guru_data.CATATAN1,
sisc_guru_data.PP1,sisc_guru_data.PP2,sisc_guru_data.PP3,sisc_guru_data.PP4,sisc_guru_data.PP5,
tssekolah.NAMASEKOLAH
FROM
users
JOIN sisc_guru_data
ON users.user_name = sisc_guru_data.SISC 
JOIN tssekolah
ON sisc_guru_data.KODSEKOLAH = tssekolah.KODSEKOLAH



 where sisc_guru_data.ID=:id");

$pdo_statement->bindParam(':id',$id);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

foreach( $result as $row ) {

   $nokp=$row['NOKP'];
   $namaguru=$row['NAMAGURU'];
   $namasekolah=$row['NAMASEKOLAH']; 
   $catatan1=$row['CATATAN1'];
   $jenisbimbingan=$row['JENISBIMBINGAN'];
    
            $hari_ini = date('d');
            $bulan_ini = date('m');
            $tahun_ini = date('Y');
            $hari_esok = date('d');
            $bulan_esok = date('m');
            $tahun_esok = date('Y');   
    
       $tarikhmula = $row['PP1'];
  
           if($tarikhmula!="") {
                 $mula_hari = date('d',strtotime($tarikhmula));
                 $mula_bulan = date('m',strtotime($tarikhmula));
                 $mula_tahun = date('Y',strtotime($tarikhmula));
                 $mula_jam = date('H',strtotime($tarikhmula));
                 $mula_minit = date('i',strtotime($tarikhmula));
                 $hari_ini = $mula_hari;
                 $bulan_ini = $mula_bulan;
                 $tahun_ini = $mula_tahun;
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
                            <li class="active"><?php echo $namappd;?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                
                
                <div class="row">
      
<form name="frmAdd" action="" method="POST">
    
    
    <?php $jenisbimbingan="";
    ?>
    
<table border="0" cellpadding="10" cellspacing="0" width="70%" align="center" class="tbl-qa">  

    <tr><td colspan="3"><h4>Pengesahan Tarikh Bimbingan  Oleh Pegawai SISC</h4></td></tr>
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
<?php                    
echo " <tr><td>Tarikh </td><td>:</td><td>";
         echo "        <select name=\"dari_hari\">";
                       for ( $counter = 1; $counter<= 31; $counter++) {
                       echo "<option value=\"$counter\"";if($counter==$hari_ini) { echo "selected"; }
                           echo ">$counter</option>";
                       }
         echo "          </select><select name=\"dari_bulan\">";
                           for ( $counter2 = 1; $counter2<= 12; $counter2++) {
                            if($counter2=="1") { $bulan="Januari"; }if($counter2=="2") { $bulan="Februari";
                                                                                       }if($counter2=="3") { $bulan="Mac"; }
                            if($counter2=="4") { $bulan="April"; }if($counter2=="5") { $bulan="Mei"; }if($counter2=="6") { $bulan="Jun"; }
                            if($counter2=="7") { $bulan="Julai"; }if($counter2=="8") { $bulan="Ogos"; }if($counter2=="9") { $bulan="September"; }
                            if($counter2=="10") { $bulan="Oktober"; }if($counter2=="11") { $bulan="November"; }if($counter2=="12") { $bulan="Disember"; }

         echo "<option value=\"$counter2\"";if($counter2==$bulan_ini) { echo "selected"; } echo ">$bulan</option>";
                        }

         echo "</select><select name=\"dari_tahun\">";
                         for ( $counter = $tahun_ini - 1; $counter<= $tahun_ini + 50; $counter++) {
         echo "<option value=\"$counter\"";if($counter==$tahun_ini) { echo "selected"; } echo ">$counter</option>";
                         }

        echo "</td></tr>";
    
       ?>     
    
 <tr class="table-row" >
     <td>Jenis Bimbingan</td><td>:</td><td>
            
    
    <select name="JENISBIMBINGAN" id="JENISBIMBINGAN">
 <?php
 	$stmt = $auth_user->runQuery("SELECT KOD,PERKARA FROM kodbimbingan");
	$stmt->execute();
	foreach ($stmt as $row) 
 {
 ?>
 
<?php print "<option value='";?><?php echo $row['KOD']; ?>'<?php if ($row['KOD']==$result[0]['JENISBIMBINGAN']) { ?>selected<?php } ?>><?php
 echo $row['PERKARA']; ?></option>

 <?php } ?>
 </select>
    
</td></tr>	  
  <tr><td>Markah</td><td>:</td><td> <input type="text" size="10" name="MARKAH1" class="demo-form-field" value="<?php echo $result[0]['MARKAH1']; ?>" > </td> </tr>   
       
    
    
    
    
    
       <tr>
    <td>
        Catatan Pegawai</td><td>: </td><td> <input type="text" size="70" name="CATATAN1" class="demo-form-field" value="<?php echo $result[0]['CATATAN1']; ?>" >
    </td>
</tr>             

  <?php  
    
    
  }
    ?>
    
 <tr class="table-row" ><td>
     
     
<?php echo "<input type=\"hidden\" name=\"ID\" value=\"$id\" />";?>
     
</td><td></td><td><input name="save_record" type="submit" value="Simpan" 
                         class="demo-form-submit">
     
<a href="../modulsisc/analisa.php?id=tovar" class="demo-form-submit"> <i class="glyphicon glyphicon-fast-backward"></i> &nbsp; Batal</a> |
     <input name="save_record2" type="submit" value="Padam Maklumat Bimbingan" 
                         class="demo-form-submit">
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
