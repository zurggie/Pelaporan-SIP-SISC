<?php
class Database
{   

    //CA180328-Old Connection Strings
    //private $host = "localhost";
    //private $db_name = "ppdmmjoh_epmjv2";
    //private $username = "root";
    //private $password = "1234";
    //public $conn;
     
    //CA180328-New Connection Strings @ Staging
    private $host = "localhost";
    private $db_name = "ppdmmjoh_sip";
    private $username = "ppdmmjoh_sip";
    private $password = "sipMoe@2018";
    public $conn;

    public function dbConnection()

	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>