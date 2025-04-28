<?php
 
require "../model/CadastroModel.php";
if($_POST){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $result = register($username, $email, $password);

    echo $result;
    if($result){
        echo "Cadastro realizado com sucesso!";
    }else{
        echo "Não foi possivel realizar o cadastro.";
    }
}