
<?php
session_start();
include('../BANCO/conexao.php');

if (isset($_POST['nome']) && isset($_POST['senha'])) {
    if (strlen($_POST['nome']) == 0) {
        echo "Preencha o seu usuário";
    } elseif (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $nome = $mysqli->real_escape_string($_POST['nome']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM cadastro WHERE nome = '$nome' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        if ($sql_query->num_rows == 1) {
            $usuario = $sql_query->fetch_assoc();

            // Definindo as variáveis de sessão
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // Redireciona para a página do painel
            header('Location: ../BANCO/painel.php');
            
        } else {
            echo "Falha ao logar! Usuário ou senha incorretos";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    
    <form action="" id="loginForm" onsubmit="enviar(event)" method="POST">
        <h2>LOGIN</h2>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite seu usuário..." >
        <p class="p">usuário ou senha errado!</p>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua Senha...">
        <p class="p">usuário ou senha errado!</p>
        <input class="btn" type="submit" value="Entrar" onclick="enviar()">
       
        <a href="cadastro.php">Cadastrar-se</a>
        <a id="senhaErrada" href="#">Esqueceu a senha?</a>
    </form>

    <div id="novaSenha">
        <label id="trocarSenha" for="novaSenha">Nova Senha:</label>
        <input type="password" name="novasenha" id="novasenha" placeholder="Digite a Nova Senha aqui...">
        <input type="button" value="Confirmar" id="confBtn" onclick="newsenha()">
    </div>
      
</body>
</html>