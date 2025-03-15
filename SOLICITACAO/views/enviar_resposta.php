<?php
require_once "../config/conexao.php"; 
session_start();

// Verifica se um ID foi passado pela URL
if (!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['resposta']) || empty($_POST['resposta'])) {
    $_SESSION['message'] = "Solicitação ou resposta não fornecida.";
    header("Location: solicitacoes_recebidas.php");
    exit();
}

$id = $_POST['id'];
$resposta = $_POST['resposta'];

// Inserir a resposta na tabela de respostas
$sql_resposta = "INSERT INTO respostas (solicitacao_id, resposta) VALUES (?, ?)";
$stmt_resposta = $conn->prepare($sql_resposta);
$stmt_resposta->bind_param("is", $id, $resposta);

if ($stmt_resposta->execute()) {
    // Excluir a solicitação após responder
    $sql_excluir = "DELETE FROM solicitacoes WHERE id = ?";
    $stmt_excluir = $conn->prepare($sql_excluir);
    $stmt_excluir->bind_param("i", $id);

    if ($stmt_excluir->execute()) {
        $_SESSION['message'] = "Solicitação respondida e excluída com sucesso.";
        header("Location: solicitacoes_recebidas.php");
        exit();
    } else {
        $_SESSION['message'] = "Erro ao excluir a solicitação. Tente novamente.";
        header("Location: responder_solicitacao.php?id=$id");
        exit();
    }
} else {
    $_SESSION['message'] = "Erro ao enviar resposta. Tente novamente.";
    header("Location: responder_solicitacao.php?id=$id");
    exit();
}

$conn->close();
?>
