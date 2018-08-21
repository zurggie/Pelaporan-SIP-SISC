<?php

	require_once("../modul/session.php");
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


 @$id= $_GET['id'];

if($userlevel=="50"){

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".btncollapse").click(function(){
        $(this).next().toggle("medium");
    });
});
</script>
</head>
<body>

<?php
$stmt3 = $auth_user->runQuery("SELECT 
tkppd.id,
tkppd.KodPPD,
tkppd.PPD
FROM
tkppd
WHERE KodNegeri='01' 
");

$stmt3->execute();
foreach ($stmt3 as $row) {
$kodppd= $row['KodPPD'];

?>
<div class="container">
  
  
  

  <div>
    <button class="btncollapse"><?php echo "$kodppd";?></button>
  
<?php    
$stmt3 = $auth_user->runQuery("SELECT 

tssekolah.id,
tssekolah.KODSEKOLAH,
tssekolah.NAMASEKOLAH,
tssekolah.KODPPD
FROM
tssekolah

 WHERE KODPPD='$kodppd' ");

$stmt3->execute();
foreach ($stmt3 as $sqlnRow) {
    $kodsekolah = $sqlnRow['NAMASEKOLAH'];
  ?>
    <div class="sppdkluang" style="display:none;">
      <?php echo "$kodsekolah";?>
    </div>
<?php
}
?>
  
  </div>
<?php
}

?>
</body>
</html>