<?php
 
class usePDO
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "atividadejean";
    private $instance;
 
    function getInstance()
    {
        if (empty($this->instance)) {
            $this->instance = $this->connection();
        }
 
        return $this->instance;
    }
 
    private function connection()
    {
        try {
            $conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}",$this->username,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            // echo "connection failed: " . $e->getMessage() . "<br>";
            die("Connection failed: " . $e->getMessage() . "<br>");
        }
    }
}
