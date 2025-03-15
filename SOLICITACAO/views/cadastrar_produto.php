<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; // Conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_produto = trim($_POST['nome_produto']);
    $preco_produto = trim($_POST['preco_produto']);
    $descricao_produto = trim($_POST['descricao_produto']);
    
    // Verifica se a imagem foi carregada
    if (isset($_FILES['imagem_produto']) && $_FILES['imagem_produto']['error'] === UPLOAD_ERR_OK) {
        // Nome e caminho da imagem
        $nome_imagem = $_FILES['imagem_produto']['name'];
        $extensao_imagem = pathinfo($nome_imagem, PATHINFO_EXTENSION);
        $nome_imagem_final = uniqid() . "." . $extensao_imagem; // Gera um nome único para evitar conflitos
        $caminho_imagem = "../uploads/" . $nome_imagem_final; // Caminho para a pasta de uploads

        // Verifica se o arquivo é realmente uma imagem
        $mime_type = mime_content_type($_FILES['imagem_produto']['tmp_name']);
        if (strpos($mime_type, 'image') === false) {
            echo "<script>alert('O arquivo enviado não é uma imagem.'); window.history.back();</script>";
            exit;
        }

        // Verifica se a pasta 'uploads' existe
        if (!file_exists("../uploads")) {
            mkdir("../uploads", 0777, true); // Cria a pasta se não existir
        }

        // Move o arquivo para a pasta de uploads
        if (!move_uploaded_file($_FILES['imagem_produto']['tmp_name'], $caminho_imagem)) {
            echo "<script>alert('Erro ao mover o arquivo para a pasta de uploads.'); window.history.back();</script>";
            exit;
        }
    } else {
        $nome_imagem = null; // Se não for enviado um arquivo, deixe como null
    }

    // Verifica se os campos não estão vazios
    if (!empty($nome_produto) && !empty($preco_produto) && !empty($descricao_produto)) {
        // Inserir os dados no banco de dados
        if ($stmt = $conn->prepare("INSERT INTO produtos (nome, preco, descricao, imagem) VALUES (?, ?, ?, ?)")) {
            // Bind params
            $stmt->bind_param("ssss", $nome_produto, $preco_produto, $descricao_produto, $nome_imagem_final);

            // Executa a query
            if ($stmt->execute()) {
                echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href = 'listar_produtos.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar o produto.'); window.history.back();</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Erro ao preparar a consulta.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
    }

    // Fecha a conexão com o banco
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Produto</h1>
        
        <form action="cadastrar_produto.php" method="POST" enctype="multipart/form-data">
            <label for="nome_produto">Nome do Produto:</label><br>
            <input type="text" id="nome_produto" name="nome_produto" placeholder="Nome do produto" required><br>

            <label for="preco_produto">Preço do Produto:</label><br>
            <input type="text" id="preco_produto" name="preco_produto" placeholder="Preço do produto" required><br>

            <label for="descricao_produto">Descrição do Produto:</label><br>
            <textarea id="descricao_produto" name="descricao_produto" placeholder="Descrição do produto" required></textarea><br><br>

            <label for="imagem_produto">Imagem do Produto:</label><br>
            <input type="file" id="imagem_produto" name="imagem_produto" accept="image/*"><br><br>

            <button type="submit">Cadastrar Produto</button>
            <button class="voltar-btn">
    <a href="../HOME/home.php" style="text-decoration: none; color: white;">Voltar</a>
</button>

            
        </form>
    </div>
</body>
</html>
