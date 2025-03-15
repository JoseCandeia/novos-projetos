<?php
require_once "../config/conexao.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Deleta a solicitação do banco de dados
    $sql = "DELETE FROM solicitacoes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Solicitação excluída com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao excluir solicitação.";
    }

    $stmt->close();
    $conn->close();
}

// Redireciona de volta para a página principal
header("Location: solicitacaoes_recebidas.php");
exit();
?>
