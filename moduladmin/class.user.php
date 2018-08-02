<?php

require_once('../data/dbconfig.php');
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
	
	public function register($uname,$umail,$upass,$uaras,$ukodppd,$ukodnegeri,$ukodsekolah)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$new_password2 = $upass;
            // $ukelas = '50';
            
        
        
            $ukodppd = strtoupper ($ukodppd);
            $umail = strtoupper($umail);
            $ukodsekolah = strtoupper($ukodsekolah);
            
            
            
            
			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass,userlevel,real_name,txtpassword,kodppd,kodnegeri,kodsekolah)VALUES(:uname, :umail, :upass, :uaras,:umail,:upass2,:ukodppd,
                                                       :ukodnegeri,:ukodsekolah)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
            $stmt->bindparam(":uaras", $uaras);
            $stmt->bindparam(":upass2", $new_password2);
            $stmt->bindparam(":ukodppd", $ukodppd);
            $stmt->bindparam(":ukodnegeri", $ukodnegeri);
            $stmt->bindparam(":ukodsekolah", $ukodsekolah);
            
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
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
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