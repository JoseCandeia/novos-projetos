<?php

require_once("config.php"); 



if (isset($_POST["acao"]) && $_POST["acao"] == "cadastrar") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $solicitacao = $_POST["solicitcao"];

    // Valida se os campos não estão vazios
    if (empty($nome) || empty($email) || empty($telefone) || empty($solicitacao)) {
        echo "<script>alert('Preencha todos os campos!'); </script>";
        exit;
    }

  
    $res = $conn->prepare("INSERT INTO clientes (nome, email, telefone, solicitacao) VALUES (?, ?, ?, ?)");
    $res->bind_param("ssss", $nome, $email, $telefone, $solicitacao);
    
    // Executa a query
    if ($res->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); location.href='?page=listar';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar.'); history.back();</script>";
    }

    $res->close();
}


$conn->close();
?>

