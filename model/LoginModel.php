<?php
require '../service/conexao.php';

function verificarLogin($email, $password) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $usuario['senha'])) {
        return true;
    } else {
        return false;
    }
}
?>
