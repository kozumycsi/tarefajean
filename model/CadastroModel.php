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

    $idPessoa = $instance->lastInsertId();
    $code = rand(100000, 999999);
    $lido = 0;
    $sql = "INSERT INTO code (username, code, email, userID) VALUES (?, ?, ?, ?)";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$username, $code, $email, $lido, $idPessoa]);

 
    $result = $stmt->rowCount();
    return $idPessoa; 
}
