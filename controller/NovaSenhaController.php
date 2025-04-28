<?php

require "../model/NovaSenhaModel.php";
session_start();

if ($_POST) {
    $novaSenha = $_POST["nova_senha"];
    $confirmSenha = $_POST["confirmar_senha"];

    if ($novaSenha == $confirmSenha) {
        $codigo = $_SESSION['codigo_verificado'];
        alterarSenha($codigo, $novaSenha);
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header("Location: ../view/login.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "As senhas não coincidem!";
        header("Location: ../view/nova_senha.php");
        exit();
    }
}
?>
