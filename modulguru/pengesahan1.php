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

if($userlevel=="7"){
    
    

if(!empty($_POST["save_record"])) {
    

    


$statuskeh=isset($_POST['STATUSKEH']) ? $_POST['STATUSKEH'] : null;    
$id=isset($_GET['id']) ? $_GET['id'] :null;  
    
$statuskeh = '1';
    
	$pdo_statement=$auth_user->runQuery("update sisc_guru set STATUSKEH=:statuskeh
    
    where ID=:id");
  
    
  
    $pdo_statement->bindParam(':statuskeh',$statuskeh); 
    
   
    $pdo_statement->bindParam(':id',$id);
	$result = $pdo_statement->execute();
	if($result) {
 header("Location: ../modulguru/index.php?id=kedatangan");
	}
}
    
if(!empty($_POST["save_record2"])) {
	



$statuskeh=isset($_POST['STATUSKEH']) ? $_POST['STATUSKEH'] : null;     
$id=isset($_GET['id']) ? $_GET['id'] :null;  
    
    
    
  

           $statuskeh = '';  
    
    
    
    
	$pdo_statement=$auth_user->runQuery("update sisc_guru set STATUSKEH=:statuskeh
    
    where ID=:id");
  
    
    
    $pdo_statement->bindParam(':statuskeh',$statuskeh); 
    
    $pdo_statement->bindParam(':id',$id);
	$result = $pdo_statement->execute();
	if($result) {
 header("Location: ../modulguru/index.php?id=kedatangan");
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
sisc_guru.PP1,sisc_guru.PP2,sisc_guru.PP3,sisc_guru.PP4,sisc_guru.PP5,

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

   $nokp=$row['NOKP'];
   $namaguru=$row['NAMAGURU'];
   $namasekolah=$row['NAMASEKOLAH']; 
   $catatan1=$row['CATATAN1'];
   $jenisbimbingan=$row['JENISBIMBINGAN'];
    
     
                  $pp1 = $row['PP1'];
                       if($pp1=="0000-00-00") { $pp1= ""; }
                       if($pp1!="") { $pp1 = date('d/m/Y',strtotime($pp1)); }      
			?>                                       
    
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
    
    
  
    
<table border="0" cellpadding="10" cellspacing="0" width="70%" align="center" class="tbl-qa">  

    <tr><td colspan="3"><h4>Pengesahan Tarikh Bimbingan Yang Pertama Oleh Pegawai SISC</h4></td></tr>
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
<tr  >
    <td>
        Tarikh Bimbingan </td><td>: </td><td><b><?php echo $pp1;?></b>
    </td>
</tr> 
<tr  >
    <td>
        Jenis Bimbingan </td><td>: </td><td><b><?php echo $jenisbimbingan;?></b>
    </td>
</tr>   
<tr  >
    <td>
        Catatan Pegawai </td><td>: </td><td><b><?php echo $catatan1;?></b>
    </td>
</tr>     
 
    
    
    
    
    
    
  
    

  <?php  
    
    
  }
    ?>
    
 <tr class="table-row" ><td>
     
     
<?php echo "<input type=\"hidden\" name=\"ID\" value=\"$id\" />";?>
     
</td><td></td><td colspan="3"><input name="save_record" type="submit" value="Pengesahan Kehadiran" 
                         class="demo-form-submit">
     
<a href="../modulguru/index.php?id=kedatangan" class="demo-form-submit"> <i class="glyphicon glyphicon-fast-backward"></i> &nbsp; Balik Ke Senarai</a>
 <input name="save_record2" type="submit" value="Batalkan Pengesahan Kehadiran" 
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
