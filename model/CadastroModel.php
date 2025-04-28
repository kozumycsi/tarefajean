<?php
 
require '../service/conexao.php';
 
function register($username, $email, $password){
    $conn = new usePDO();
    $instance = $conn->getInstance();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO pessoa (nome, email)VALUES (?, ?)";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$username, $email]);
    $idPessoa = $instance->lastInsertId();
    $sql = "INSERT INTO usuario (email, senha, pessoa_id) VALUES (?, ?, ?)";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$email, $hashed_password, $idPessoa]);
 
    $result = $stmt->rowCount();
    return $idPessoa; 
}
