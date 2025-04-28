<?php

require "../service/conexao.php";

function verificaEmail($email) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$email]);

    return $stmt->rowCount() > 0;
}

function gerarCodigo() {
    return rand(100000, 999999);
}

function salvarCodigo($email, $codigo) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "INSERT INTO codigos (email, codigo) VALUES (?, ?)";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$email, $codigo]);
}
function verificarCodigo($codigo) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM codigos WHERE codigo = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$codigo]);

    return $stmt->rowCount() > 0;
}
?>
