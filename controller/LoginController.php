<?php

require "../model/LoginModel.php";
session_start();

if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = login($email, $password);

    if ($result) {
        $_SESSION['usuario_id'] = $result['id'];
        $_SESSION['mensagem'] = "Login realizado com sucesso!";
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Email ou senha incorretos!";
        header("Location: ../view/login.php");
        exit();
    }
}
?>
