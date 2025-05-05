<?php
require_once '../service/conexao.php';

function buscarEmails() {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $emails = array();
    $sql = "SELECT * FROM code";
    try {
        $resultado = $instance->query($sql);

        if ($resultado && $resultado->rowCount() > 0) {
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $emails[] = $row;
            }
        }
    } catch (PDOException $e) {
        error_log("Error in buscarEmails(): " . $e->getMessage());
        return [];
    }

    return $emails;
}

function buscarEmailPorId($id) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT * FROM code WHERE id = ?";
    try {
        $stmt = $instance->prepare($sql);
        $stmt->execute([$id]);

        if ($stmt && $stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        error_log("Error in buscarEmailPorId(): " . $e->getMessage());
        return null;
    }

    return null;
}

function marcarComoLido($id) {
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "UPDATE code SET lido = 1 WHERE id = ?";
    try {
        $stmt = $instance->prepare($sql);
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error in marcarComoLido(): " . $e->getMessage());
        return false;
    }
}

function formatarData($data) {
    if ($data) {
        $timestamp = strtotime($data);
        return date('d/m/Y', $timestamp);
    }
    return '';
}
?>