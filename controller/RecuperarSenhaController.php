<?php

require "../model/RecuperarSenhaModel.php";
session_start();

if ($_POST) {
    $email = $_POST["email"];

    if (verificaEmail($email)) {
        $codigo = gerarCodigo();
        salvarCodigo($email, $codigo);
        $_SESSION['mensagem'] = "Código de recuperação enviado!";
        header("Location: ../view/verificar_codigo.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Email não encontrado!";
        header("Location: ../view/recuperar_senha.php");
        exit();
    }
}
?>
