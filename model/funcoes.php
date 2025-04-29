<?php
require_once '../service/conexao.php';

// Função para buscar todos os emails (códigos)
function buscarEmails() {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $emails = array();
    $sql = "SELECT * FROM code";
    $resultado = $instance->query($sql);

    if ($resultado && $resultado->rowCount() > 0) {
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $emails[] = $row;
        }
    }

    return $emails;
}

// Função para buscar um email específico pelo ID
function buscarEmailPorId($id) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM code WHERE id = ?";
    $stmt = $instance->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt && $stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return null;
}

// Função para marcar um email como lido
function marcarComoLido($id) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "UPDATE code SET lido = 1 WHERE id = ?";
    $stmt = $instance->prepare($sql);
    return $stmt->execute([$id]);
}

// Função para formatar a data
function formatarData($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y', $timestamp);
}
?>
