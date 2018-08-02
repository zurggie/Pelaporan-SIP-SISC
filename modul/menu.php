<?php 



	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $tingkatan=$userRow['tingkatan'];
    $namapengguna=$userRow['user_name'];
    $kelas=$userRow['kelas'];
    $gurukelas=$userRow['real_name'];
    $kodsekolah=$userRow['kodsekolah'];
    $kodppd=$userRow['kodppd'];
    $kodnegeri=$userRow['kodnegeri'];
    $userlevel=$userRow['userlevel'];


 @$id= $_GET['id'];

if($userlevel=="100"){?>
	<script type="text/javascript">
            window.location.href = "../modulkpm/"
        
        </script>
<?php
        }

if($userlevel=="50"){?>
	<script type="text/javascript">
            window.location.href = "../modulppd/"
        
        </script>
<?php
        }

if($userlevel=="10"){?>
	<script type="text/javascript">
            window.location.href = "../modulsekolah/"
        
        </script>
<?php
        }

if($userlevel=="60"){?>
	<script type="text/javascript">
            window.location.href = "../moduljpn/"
        
        </script>
<?php
        }

if($userlevel=="255"){?>
	<script type="text/javascript">
            window.location.href = "../moduladmin/"
        
        </script>
<?php
        }

if($userlevel=="7"){?>
	<script type="text/javascript">
            window.location.href = "../modulguru/"
        
        </script>
<?php
        }


if($userlevel=="20"){?>
	<script type="text/javascript">
            window.location.href = "../modulsip/"
        
        </script>
<?php
        }

if($userlevel=="15"){?>
	<script type="text/javascript">
            window.location.href = "../modulsisc/"
        
        </script>
<?php
        }

if($userlevel==""){
	   header("Location: ../modulppd/logout.php?logout=true");

        }