<?php
 
require "../model/CadastroModel.php";
if($_POST){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if ($password !== $confirm_password) {
        session_start();
        $_SESSION['mensagem'] = "As senhas não coincidem!";
        header('Location: ../view/cadastro.php');
        exit();
    }
    $result = register($username, $email, $password);

    echo $result;
    if($result){
        echo "Cadastro realizado com sucesso!";
        header('Location: ../view/index.php');
    }else{
        echo "Não foi possivel realizar o cadastro.";
        header('Location: ../view/cadastro.php');
    }
    exit();
}