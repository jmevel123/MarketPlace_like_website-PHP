<?php

class connect_DB{

    const  ERROR_LOG_FILE = "error_log_file.log";
    private $conn;

    public function __construct($host, $username, $passwd, $port, $db){
    try{
        $this->conn = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$db, $username, $passwd);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        
        }
    catch(PDOException $e){
            $content = "Connection failed: " .$e->getMessage()."\n";
            file_put_contents(ERROR_LOG_FILE, $content,FILE_APPEND);
            die("Connection failed: " .$e->getMessage());
        }
    }


    public function getConn()
    {
        return $this->conn;
    }
}
   
?>