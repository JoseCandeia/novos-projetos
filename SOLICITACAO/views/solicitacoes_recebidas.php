<?php
require_once "../config/conexao.php"; 
session_start();

// Consulta para recuperar todas as solicitações
$sql = "SELECT id, nome, email, telefone, solicitacao, data_solicitacao FROM solicitacoes ORDER BY data_solicitacao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações Recebidas</title>
    <link rel="stylesheet" href="../assets/css/solicitacao-cliente.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        td {
            background-color: #f1f1f1;
        }

        .message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .responder-btn {
            background-color: #ff9800;
            color: white;
        }

        .responder-btn:hover {
            background-color: #e68900;
        }

        .back-btn {
            display: inline-block;
            background-color: #28a745;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <a href="../views/adm.php" class="back-btn">Voltar</a>
    <h2>Solicitações Recebidas</h2>

    <?php
    // Exibe mensagem de sucesso ou erro após ações
    if (isset($_SESSION['message'])) {
        echo "<p class='message'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    ?>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Solicitação</th>
            <th>Data da Solicitação</th>
            <th>Ações</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row['solicitacao'])) . "</td>";
                echo "<td>" . $row['data_solicitacao'] . "</td>";
                echo "<td>
                        <a href='responder_solicitacao.php?id=" . $row['id'] . "' class='btn responder-btn'>Responder</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhuma solicitação encontrada.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
