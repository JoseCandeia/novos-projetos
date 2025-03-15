<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; 

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
        $caminho_imagem = __DIR__ . "/../uploads/" . $nome_imagem_final; // Caminho absoluto para a pasta de uploads

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
            
            $stmt->bind_param("ssss", $nome_produto, $preco_produto, $descricao_produto, $nome_imagem_final);

            
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

    
    $conn->close();
}
?>
