<?php

require "../model/RecuperarSenhaModel.php";
session_start();

if ($_POST) {
    $codigo = $_POST["codigo"];

    if (verificarCodigo($codigo)) {
        $_SESSION['codigo_verificado'] = $codigo;
        $_SESSION['mensagem'] = "Código verificado com sucesso!";
        header("Location: ../view/nova_senha.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Código inválido!";
        header("Location: ../view/verificar_codigo.php");
        exit();
    }
}
?>
