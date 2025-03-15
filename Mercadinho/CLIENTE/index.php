<?php

if(isset($_POST['submit']))
{
//     print_r($_POST['nome']);
//     print_r('<br>');
//     print_r($_POST['email']);
//     print_r('<br>');
//     print_r($_POST['contato']);
//     print_r('<br>');
//     print_r($_POST['senha']);
//     print_r('<br>');
//     print_r($_POST['mensagem']);
// }

include_once('../BANCO/config.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$contato = $_POST['contato'];
$senha = $_POST['senha'];
$mensagem = $_POST['mensagem'];

$result = mysqli_query($conexao, "INSERT INTO usuarios (nome, email, contato, senha, solicitacao) 
VALUES ('$nome', '$email', '$contato', '$senha', '$mensagem')");


}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" href="../CSS/cliente.css">
</head>
<body>
    <form id="formSolicitacao" action="index.php" method="POST">
        <h2>Solicitação do Cliente</h2>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email" required>

        <label for="contato">Contato:</label>
        <input type="tel" id="contato" name="contato" placeholder="Digite seu telefone"required >

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>

        <label for="mensagem">Escreva aqui:</label>
        <textarea id="mensagem" name="mensagem" placeholder="Explique sua solicitação" required></textarea>

       <input type="submit" name="submit" id="submit" value="Enviar" onclick="enviar()" >
       
      
    </form>

</body>
</html>