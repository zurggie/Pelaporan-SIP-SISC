<?php 
  @require_once("../modul/session.php");
  require_once("../modul/class.user.php");
  $auth_user = new USER();
  
  $id=$_GET['id'];
  $sql = $auth_user->runQuery("DELETE FROM sisc_guru_data WHERE ID=:i");  
  $sql->bindParam(":i",$id); 
  $sql->execute();

  header('Location: analisa.php?id=tovar');
  exit();
?>