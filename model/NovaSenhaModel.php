<?php

require "../service/conexao.php";

function alterarSenha($codigo, $novaSenha) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT email FROM codigos WHERE codigo = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$codigo]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $email = $row['email'];
        $hashedPassword = password_hash($novaSenha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuario SET senha = ? WHERE email = ?";
        $stmt = $instance->prepare($sql);
        $stmt->execute([$hashedPassword, $email]);

        return true;
    }
    return false;
}
?>
