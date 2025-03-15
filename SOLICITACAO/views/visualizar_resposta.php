<?php
require_once "../config/conexao.php"; 
session_start();

// Verifica se um ID foi passado pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "Nenhuma solicitação encontrada.";
    header("Location: ../views/solicitacoes_recebidas.php");
    exit();
}

$id = $_GET['id'];

// Consulta para obter os detalhes da solicitação
$sql_solicitacao = "SELECT nome, email, telefone, solicitacao, data_solicitacao FROM solicitacoes WHERE id = ?";
$stmt_solicitacao = $conn->prepare($sql_solicitacao);
$stmt_solicitacao->bind_param("i", $id);
$stmt_solicitacao->execute();
$result_solicitacao = $stmt_solicitacao->get_result();
$solicitacao = $result_solicitacao->fetch_assoc();

// Consulta para obter a resposta
$sql_resposta = "SELECT resposta, data_resposta FROM respostas WHERE solicitacao_id = ?";
$stmt_resposta = $conn->prepare($sql_resposta);
$stmt_resposta->bind_param("i", $id);
$stmt_resposta->execute();
$result_resposta = $stmt_resposta->get_result();
$resposta = $result_resposta->fetch_assoc();

if (!$solicitacao) {
    $_SESSION['message'] = "Solicitação não encontrada.";
    header("Location: ../views/solicitacoes_recebidas.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Solicitação Respondida</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f1f1f1; color: #333; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h1 { color: #007BFF; text-align: center; }
        p { font-size: 16px; line-height: 1.6; margin: 10px 0; }
        .label { font-weight: bold; }
        .response { background-color: #f9f9f9; padding: 15px; border-radius: 8px; margin-top: 20px; border: 1px solid #ccc; }
        .back-btn { display: block; width: 150px; margin: 20px auto; text-align: center; padding: 10px 0; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px; }
        .back-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Solicitação Respondida</h1>

        <p><span class="label">Nome:</span> <?= htmlspecialchars($solicitacao['nome']) ?></p>
        <p><span class="label">Email:</span> <?= htmlspecialchars($solicitacao['email']) ?></p>
        <p><span class="label">Telefone:</span> <?= htmlspecialchars($solicitacao['telefone']) ?></p>
        <p><span class="label">Solicitação:</span><br> <?= nl2br(htmlspecialchars($solicitacao['solicitacao'])) ?></p>
        <p><span class="label">Data da Solicitação:</span> <?= $solicitacao['data_solicitacao'] ?></p>

        <?php if ($resposta): ?>
            <div class="response">
                <p><span class="label">Resposta:</span><br> <?= nl2br(htmlspecialchars($resposta['resposta'])) ?></p>
                <p><span class="label">Data da Resposta:</span> <?= $resposta['data_resposta'] ?></p>
            </div>
        <?php else: ?>
            <p><strong>Resposta ainda não foi fornecida.</strong></p>
        <?php endif; ?>

        <a href="../views/solicitacoes_recebidas.php" class="back-btn">Voltar para Solicitações</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
