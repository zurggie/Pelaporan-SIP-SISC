<?php 
	@require_once("../modul/session.php");
	require_once("../modul/class.user.php");
	$auth_user = new USER();
	
    $id=$_GET['ID'];
	$sql = $auth_user->runQuery("DELETE FROM bersara_nama WHERE ID=:i");  
	$sql->bindParam(":i",$id ); 
	$sql->execute();

	header('location: index.php?id=pencen');		
?>