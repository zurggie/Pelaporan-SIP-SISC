<?php 
	@require_once("../modul/session.php");
	require_once("../modul/class.user.php");
	$auth_user = new USER();
	
    $id=$_GET['user_id'];
	$sql = $auth_user->runQuery("DELETE FROM users WHERE user_id=:i");  
	$sql->bindParam(":i",$id ); 
	$sql->execute();

	header('location:home.php?id=senarai');		
?>