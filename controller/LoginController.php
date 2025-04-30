<?php
require "../model/LoginModel.php";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginResult = verificarLogin($email, $password);

    if (!$loginResult) {

        $_SESSION['mensagemerro'] = "Email ou senha incorretos!";
        $_SESSION['mensagem'] = "<div style='position:fixed;
        top:10px;
        left:50%;
        transform:translateX(-50%);
        background-color:pink;
        padding:10px;border-radius:10px;
        font-weight:bold;
        z-index:9999;
        '>" . $_SESSION['mensagemerro'] . "</div>";
        header('Location: ../view/login.php');
        unset($_SESSION['mensagemerro']);
        exit();
    } else {
        $_SESSION['mensagemerro'] = "Login feito com sucesso!";
        $_SESSION['mensagem'] = "<div style='position:fixed;
        top:10px;
        left:50%;
        transform:translateX(-50%);
        background-color:pink;
        padding:10px;border-radius:10px;
        font-weight:bold;
        z-index:9999;
        '>" . $_SESSION['mensagemerro'] . "</div>";
        header('Location: ../view/paginainicial.php');
        exit();
    }
} else {
    header('Location: ../view/index.php');
    exit();
}
?>