<?php

require "../service/conexao.php";

function login($email, $password) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['senha'])) {
        return $usuario;
    }

    return false;
}
?>
