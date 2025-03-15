<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; // Certifique-se do caminho correto para a conexão

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Previne SQL Injection
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();
} else {
    echo '<h1 style="font-size: 30px; color: red; text-align: center;">Produto não encontrado!</h1>';
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Produto</title>
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <?php include '../HOME/menu.php'; ?> 
    <div class="content">
        <h1 >Detalhes do Produto</h1>
        <?php if ($produto) { ?>
            <p><strong>ID:</strong> <?php echo $produto['id']; ?></p>
            <p><strong>Nome:</strong> <?php echo $produto['nome']; ?></p>
            <p><strong>Preço:</strong> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            <p><strong>Descrição:</strong> <?php echo $produto['descricao']; ?></p>
            <p><strong>Imagem:</strong> <img src="../assets/images/<?php echo $produto['imagem']; ?>" alt="Imagem" width="150"></p>
        <?php } ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
