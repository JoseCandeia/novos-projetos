<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; 

// Consulta SQL para obter todos os produtos
$sql = "SELECT * FROM produtos";  
$result = $conn->query($sql);  // Executa a consulta no banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Produtos</title>
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Produtos</h1>
        
        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($produto = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($produto['data_cadastro'])); ?></td>
                        <td>
                            <a href="verificar_produto.php?id=<?php echo $produto['id']; ?>"><button>Ver Detalhes</button></a>
                            <a href="excluir_produto.php?id=<?php echo $produto['id']; ?>"><button class="delete">Excluir</button></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Não há produtos cadastrados.</p>
        <?php endif; ?>
    </div>
    <button class="voltar-btn1">
                <a href="../views/adm.php" style="text-decoration: none; color: white; ">Voltar</a>
            </button>
</body>
</html>

<?php
$conn->close();  // Fecha a conexão com o banco
?>
