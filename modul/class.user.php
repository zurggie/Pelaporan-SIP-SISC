<?php

require_once ('../data/dbconfig.php');
require_once ('../modul/passwordLib.php');
class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($umail,$uname,$upass,$uaras,$ukodppd,$ukodnegeri)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$new_password2 = $upass;
            
            $umail = strtoupper($umail);
           $ukelas = '10';
            
            
$stmt = $this->conn->prepare("INSERT INTO users(real_name,user_name,user_pass,txtpassword,userlevel,kodppd,kodnegeri) 
		     VALUES(:uname,:umail,:upass,:upass2,:uaras,:ukodppd,:ukodnegeri)");
            
			$stmt->bindparam(":umail", $umail);									  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":upass2", $new_password2);
            $stmt->bindparam(":uaras", $uaras);
            $stmt->bindparam(":ukodppd",$ukodppd);
            $stmt->bindparam(":ukodnegeri",$ukodnegeri);
            
			$stmt->bindparam(":upass", $new_password);	
            
            //$stmt->bindparam(":kodsekolah", $kodsekolah); 
			//$stmt->bindparam(":kodppd", $kodppd);
            
          
           
            
           // $kodppd=$_POST['kodppd'];
           // $kodsekolah=$_POST['kodsekolah'];
           // $kodnegeri=$_POST['kodnegeri'];
            
             
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass, userlevel FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
               // $upass = md5($_POST['user_pass']);
                
                
				if(password_verify ($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>