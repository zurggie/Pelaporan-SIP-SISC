<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
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

if($userlevel=="50"){
        
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                    <!-- .Megamenu -->
                    <li><a class="navbar-brand" style="color:white;" href="#">SISTEM PELAPORAN SIP</a></li>
                    <!-- /.Megamenu -->
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
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
        <div class="navbar-default sidebar" role="navigation" style="background: #fffde7">
            <div class="sidebar-nav slimscrollsidebar">

                <div class="user-profile" style="margin-top:1rem;">
                    <div class="dropdown user-pro-body">
                        <div><img src="../logo.png" alt="user-img" style="width:80px;"></div>
                        <div><strong><?php echo $namapenuh;?></strong></div>
                        <div style="font-size:3rem;width:90%;margin: auto;">ADMIN PPD</div>
                        <div style="font-size:1.1rem;width:90%;margin: auto;"><?php echo $namappd;?></div>
                        <a href="logout.php?logout=true" class="btn btn-sm btn-danger" style="margin-top:1rem;">LOG KELUAR</a>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                
                 
  <!-- ============================= MULA MENU 1 ================================= -->   
    
    
<li><a href="index.php" class="waves-effect"><i class="mdi mdi-home fa-fw"></i> <span class="hide-menu">Muka Depan</span></a></li>     
    
    
    
    
    
    
                 
 <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-certificate fa-fw" data-icon="v"></i> 
                       
 <?php                     
$sql = "SELECT bar_menu.ID,
bar_menu.KOD,
bar_menu.MENU,
bar_menu.TAG
FROM
bar_menu

WHERE bar_menu.KOD ='1' AND bar_menu.TAG='PPD'";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
$menu=$row['MENU']; ?>                    
                      
                      
                      
                        <span class="hide-menu"> 
                            <?php echo $menu;?>
                            <span class="fa arrow"></span> </span></a>
                      
    <?php }
}
    ?>
      <!-- ========================== MULA SUB MENU 1 ==================================== -->
                        <ul class="nav nav-second-level">
                            
<?php                          

$sql = "SELECT bar_sub.ID,bar_sub.KOD,bar_sub.MENU AS SUBMENU,bar_sub.HTTP,bar_sub.TAG
FROM
bar_sub
WHERE bar_sub.KOD ='1' AND bar_sub.TAG='PPD'
ORDER BY bar_sub.KOD ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
$submenu=$row['SUBMENU'];
$http=$row['HTTP'];                           
                            ?>
    
                            <li>
                                
                                
                                <?php
                                echo "<a href=\"$http\">";?>
                                
                                
                                
                                <i class="fa fa-hand-o-right fa-fw"></i><span class="hide-menu"><?php echo "$submenu";?></span></a> </li>
                            
                            <?php } ?>
                        </ul>
                    </li>
                       
<?php } ?>
                    
 
   <!-- ============================ MULA MENU 2 ================================== -->  
    
 <li> <a href="javascript:void(0);" class="waves-effect">
     
    <i class="fa fa-line-chart fa-fw"></i> 
                       
 <?php                     
$sql = "SELECT bar_menu.ID,
bar_menu.KOD,
bar_menu.MENU,
bar_menu.TAG
FROM
bar_menu

WHERE bar_menu.KOD ='2' AND bar_menu.TAG='PPD'";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
$menu=$row['MENU']; 
  
     ?>                    
                      
                      
                      
                        <span class="hide-menu"> 
                            <?php echo $menu;?>
                            <span class="fa arrow"></span> </span></a>
                      
    <?php }
}
    ?>
     <!-- ========================== MULA SUB MENU 2 ==================================== -->
     
                        <ul class="nav nav-second-level">
                            
                           <?php                          
  

$sql = "SELECT bar_sub.ID,bar_sub.KOD,bar_sub.MENU AS SUBMENU,bar_sub.HTTP,bar_sub.TAG
FROM
bar_sub
WHERE bar_sub.KOD ='2' AND bar_sub.TAG='PPD'
ORDER BY bar_sub.KOD ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
$submenu=$row['SUBMENU']; 
$http=$row['HTTP'];                               
                            ?>
    
                            <li> 
                                
                              <?php
                                echo "<a href=\"$http\">";?>
                               <i class="fa fa-bookmark fa-fw"></i> <span class="hide-menu"><?php echo "$submenu";?></span></a> </li>
                            
                            <?php } ?>
                        </ul>
                    </li>
                       
<?php } ?>    
    
    
  <!-- ============================= MULA MENU 3 ================================= -->   

 <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-line-chart fa-fw" data-icon="v"></i> 
                       
 <?php                     
$sql = "SELECT bar_menu.ID,
bar_menu.KOD,
bar_menu.MENU,
bar_menu.TAG
FROM
bar_menu

WHERE bar_menu.KOD ='3' AND bar_menu.TAG='PPD'";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
$menu=$row['MENU']; ?>                    
                      
                      
                      
                        <span class="hide-menu"> 
                            <?php echo $menu;?>
                            <span class="fa arrow"></span> </span></a>
                      
    <?php }
}
    ?>
     <!-- ========================== MULA SUB MENU 3 ==================================== -->
                        <ul class="nav nav-second-level">
                            
                           <?php                          
  

$sql = "SELECT bar_sub.ID,bar_sub.KOD,bar_sub.MENU AS SUBMENU,bar_sub.HTTP,bar_sub.TAG
FROM
bar_sub
WHERE bar_sub.KOD ='3' AND bar_sub.TAG='PPD'
ORDER BY bar_sub.KOD ASC";
	
$result = $auth_user->runQuery($sql);
$result->bindParam(':namapengguna', $namapengguna);	
$result->execute();
         
   
if ($result->rowCount() > 0) {		
foreach ($result as $row3) {
$submenu3=$row3['SUBMENU']; 
$http3=$row3['HTTP'];
                            ?>
    
                            <li> 
                                
                             <?php
    
                                echo "<a href=\"$http3\">";?>
                                
                                
                                <i class="fa fa-bookmark fa-fw" data-icon="v"></i><span class="hide-menu"><?php echo "$submenu3";?></span></a> </li>
                            
                            <?php } ?>
                        </ul>
                    </li>
                       
<?php } ?>    
         
                    
                    
                    
                    
                    
                    
                    
                    
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper" style="background: url('../img/tilekpm.png') repeat;background-size: 200px 200px;">
            <div class="container-fluid">
                <div class="row bg-title" style="background: rgba(0, 0, 0, 0.2);">
                    <div class="col-xs-12" style="font-size:2rem;">
                        <marquee>
                            MAKLUMAT TERKINI! : Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ipsum aperiam iusto iure accusantium enim at maxime deserunt! Voluptatibus, quibusdam!
                        </marquee>
                    </div>
                </div>
                <!-- /row -->
                
                
                <div class="row">
                <style>
                .backwhite {
                    background-color:white;
                    border-style: solid;
                    border-width: 1px;
                    border-color: silver;
                    padding:3rem;
                    margin-bottom:2rem;
                }
                .mtb {
                    margin-top:1rem;
                    margin-bottom:1rem;
                }
                .mypanel {
                    border-style: solid;
                    border-width: 1px;
                    border-color: silver;
                    margin-top: 2rem;
                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                    transition: 0.3s;
                    border-radius: 5px; /* 5px rounded corners */
                }
                .mypanel-body {
                    padding: 2px 16px;
                }
                </style>
                <!-- =============================================================== -->
                <!-- PAGE SEMUA BERMULA DI SINI -->

                <?php
                    if(isset($_GET['page'])) {
                        if($_GET['page']=="depan") {
                            include 'bahagian/depan.php';
                        } elseif($_GET['page']=="karang") {
                            include 'bahagian/karang.php';
                        } elseif($_GET['page']=="jenisprog") {
                            include 'bahagian/jenisprog.php';
                        } elseif($_GET['page']=="jenisbimb") {
                            include 'bahagian/jenisbimb.php';
                        } elseif($_GET['page']=="senaraisip") {
                            include 'bahagian/senaraisip.php';
                        } elseif($_GET['page']=="bilbimsip") {
                            include 'bahagian/bilbimsip.php';
                        } elseif($_GET['page']=="bilbimsipstd") {
                            include 'bahagian/bilbimsipstd.php';
                        } elseif($_GET['page']=="senaraisisc") {
                            include 'bahagian/senaraisisc.php';
                        } elseif($_GET['page']=="bilbimsisc") {
                            include 'bahagian/bilbimsisc.php';
                        } elseif($_GET['page']=="bilbimsiscstd") {
                            include 'bahagian/bilbimsiscstd.php';
                        }
                    } else {
                        include 'bahagian/depan.php';
                    }
                    
                ?>

                <!-- PAGE BERAKHIR DI SINI -->             
                <!-- =============================================================== -->    
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
            <footer class="footer text-center" style="background: rgba(255, 255, 255, 0);"><strong>2018 &copy; Bahagian Pengurusan Sekolah Harian Kementerian Pendidikan Malaysia<strong></footer>
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
