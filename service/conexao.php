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
function instancia(){
    // Arquivo de conexão com o banco de dados
    
    // Configurações do banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "atividadejean";
    
    // Criar conexão
    $conexao = new mysqli($servidor, $usuario, $senha, $banco);
    
    // Verificar conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    
    // Definir charset para UTF-8
    $conexao->set_charset("utf8");
}
