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

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

        
        @$id= $_GET['id'];

if($userlevel=="255"){
    
    



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Selamat Datang Pengguna Admin SIP+ Dan SISC+ - <?php print($userRow['user_email']); ?></title>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php?id=senarai">Senarai Nama</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
    
            <li><a href="../moduladmin/sign-up.php">Daftar Pengguna</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Profil</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Keluar</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">Selamat Datang : <?php print($userRow['user_name']); ?></label>
        <hr />
        
     
       <?php
        
       
        
         if($id=="daftar"){
              
           echo "daftar";  
         }
        
        
        
if($id=="senarai"){
    
                        

$sql = "SELECT

users.user_id,
users.user_name,
users.real_name,
users.user_email,
users.user_pass,
users.txtpassword,
users.joining_date,
users.userlevel,
users.kodsekolah,
users.kelas,
users.tingkatan,
users.kodppd,
users.RM,
users.kodnegeri,
tkppd.NAMAPPD,
tknegeri.NAMANEGERI
FROM
users
LEFT JOIN tkppd
ON users.kodppd = tkppd.KODPPD 
LEFT JOIN tknegeri
ON tkppd.KODNEGERI = tknegeri.KODNEGERI

ORDER BY users.kodnegeri,users.kodppd ASC  ";


$result = $auth_user->runQuery($sql);
$result->bindParam(':kodnegeri', $kodnegeri);	
$result->execute();
       
    
  ?> 
  
    <table border=1 width=100%>
    <tr><th>#</th>
        <th>Nama</th><th>Nama Pengguna</th><th>Katalaluan</th><th>Aras</th>
        <th>Kod PPD</th><th>Kod Negeri</th>
        </tr>
    
    
    <?php
    
$bil=0;
    
if ($result->rowCount() > 0) {		
foreach ($result as $row) {
                        $namapengguna=$row['user_name'];
                        $nama=$row['real_name'];
                        $katalaluan=$row['txtpassword'];
                        $aras=$row['userlevel'];
                        $kodppd=$row['kodppd'];
                        $kodnegeri=$row['kodnegeri'];
                        $namappd=$row['NAMAPPD'];
                        $namanegeri=$row['NAMANEGERI'];
 $bil++;   
                        ?>
    
  
        <tr><td><?php echo $bil;?></td>
        <td><?php echo $nama;?></td><td><?php echo $namapengguna;?> </td><td><?php echo $katalaluan;?> </td><td><?php echo $aras;?> </td>
            <td><?php echo "$kodppd $namappd";?> </td>
            <td><?php echo " $kodnegeri $namanegeri";?> </td>
              <td><a href="../moduladmin/padam.php?user_id=<?php echo $row["user_id"]; ?>" class="link"><img name="delete" id="delete" title="Padam" onclick="return confirm('Anda Pasti Hendak Padam Rekod Ini?')" src="../icon/delete.png"/></a></td>
        </tr>

<?php
}
}
?>
    </table>
            
  <?php          
}
    
    
    
    }
                
                
         else
     {
         
     header("Location: ../modul/logout.php?logout=true");     
         
     }    
    
    
        
        ?>
        
        
        
        
  
    
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>