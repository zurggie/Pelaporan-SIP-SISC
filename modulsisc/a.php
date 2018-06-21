<!DOCTYPE html>
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
?>



<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Example of Creating Bootstrap Collapsible Accordion Widget </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel-group" id="accordion"> <!-- accordion 1 -->
   <div class="panel panel-primary">
       
       
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
      
      

    
      
      
  
            
$bil=0;
if ($result->rowCount() > 0) {		
foreach ($result as $row) {

                        $id=$row['ID'];
                        $nama=$row['NAMAGURU'];
                        $nokp=$row['NOKP'];
                        $namasekolah=$row['NAMASEKOLAH'];
                       
    
           
                        $bil++;
    
}
}
			?>  
       
        <div class="panel-heading"> <!-- panel-heading -->
            <h4 class="panel-title"> <!-- title 1 -->
            <a data-toggle="collapse" data-parent="#accordion" href="#accordionOne">
            1. <?php echo $nama;?>
            </a>
           </h4>
        </div>
        <!-- panel body -->
        <div id="accordionOne" class="panel-collapse collapse in">
          <div class="panel-body">
              
              
           HTML is used for web designing, ever you think how web browser display web pages for you. <a href="http://www.expertphp.in/article/what-is-html-and-why-html-is-important" target="_blank">Learn more.</a>
          </div>
        </div>
       
       
       
       
       
  </div>
    
    
    
    
    
    
    
   <div class="panel panel-success">  <!-- accordion 2 -->
          <div class="panel-heading"> 
          <h4 class="panel-title"> <!-- title 2 -->
            <a data-toggle="collapse" data-parent="#accordion" href="#accordionTwo">
              2. What is PHP ?
            </a>
          </h4>
          </div>
         <!-- panel body -->
        <div id="accordionTwo" class="panel-collapse collapse">
          <div class="panel-body">
            You are allowed to build dynamic websites with the help of PHP. You can run PHP on any platform whether it is UNIX, Linux and windows.<a href="http://www.expertphp.in/article/what-is-php-language" target="_blank">Learn more.</a>
          </div>
        </div>   
   </div>
  
    
    
    

</body>
</html>   