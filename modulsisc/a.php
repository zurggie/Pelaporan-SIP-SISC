<?php


  require_once("../modul/class.user.php");
  $auth_user = new USER();
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
tkppd.KODPPD,
tkppd.NAMAPPD
FROM
tkppd
WHERE KODNEGERI='01' 
");

$stmt3->execute();
foreach ($stmt3 as $row) {
$kodppd= $row['KODPPD'];

?>
<div class="container">
  
  
  

  <div>
<button class="btncollapse" style="margin-top:1rem;"><?php echo "$kodppd";?></button>
  
<?php    
$stmt3 = $auth_user->runQuery("SELECT 

tssekolah.KODSEKOLAH,
tssekolah.NAMASEKOLAH,
tssekolah.KODPPD
FROM
tssekolah

 WHERE KODPPD='$kodppd' ");

$stmt3->execute();
echo' <div style="display:none">';
foreach ($stmt3 as $sqlnRow) {
    $kodsekolah = $sqlnRow['NAMASEKOLAH'];
  ?>
    <div>
      <?php echo "$kodsekolah";?>
    </div>
<?php
}
echo'</div>';
?>
  
  </div>
<?php
}

?>
</body>
</html>