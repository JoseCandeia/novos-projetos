<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; // Certifique-se do caminho correto para a conexão

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o produto
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Previne SQL Injection
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Produto excluído com sucesso!'); window.location.href = 'listar_produtos.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto!'); window.location.href = 'listar_produtos.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
