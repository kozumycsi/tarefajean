<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem'])) {
    echo "<div style='position:fixed;
    top:10px;
    left:50%;
    transform:translateX(-50%);
    background-color:pink;
    padding:10px;border-radius:10px;
    font-weight:bold;
    z-index:9999;
    '>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}
?>
