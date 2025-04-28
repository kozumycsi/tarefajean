<?php
session_start();

if (!empty($_SESSION['mensagem'])) {
    echo "<div style='
        padding: 15px; 
        background-color: #f0f0f0; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        margin-bottom: 20px; 
        text-align: center;
        font-weight: bold;
    '>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']);
}
?>
