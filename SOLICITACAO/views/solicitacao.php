<?php
require_once "../config/conexao.php";
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados enviados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $solicitacao = $_POST['solicitacao'];

    // Insere a solicitação no banco de dados
    $sql = "INSERT INTO solicitacoes (nome, email, telefone, solicitacao, data_solicitacao) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $telefone, $solicitacao);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Solicitação enviada com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao enviar solicitação.";
    }

    // Redireciona para a página de solicitações recebidas
    header("Location:../views/solicitacoes_recebidas.php");
    exit();
}

$conn->close();
?>
