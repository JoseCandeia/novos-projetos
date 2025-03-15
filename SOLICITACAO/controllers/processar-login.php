<?php
session_start();

// Incluir o arquivo de conexão com o banco de dados
require_once "../config/conexao.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Condição para verificar se o nome de usuário é 'ADM' e a senha é '1234'
    if ($nome === 'ADM' && $senha === '1234') {
        // Se for 'ADM' e senha '1234', redireciona para a página de administração
        $_SESSION['usuario'] = 'ADM';
        header("Location: ../views/adm.php");
        exit();
    }

    // Consulta SQL para verificar se o nome de usuário existe
    $sql = "SELECT * FROM usuarios WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado, verifica a senha
        $usuario = $result->fetch_assoc();
        
        // Verifica se a senha está correta (supondo que as senhas estejam salvas com hash)
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, cria a sessão e redireciona para a home
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: ../HOME/home.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['error'] = 'Senha incorreta!';
            header("Location: ../views/index.php");
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['error'] = 'Usuário não encontrado!';
        header("Location: ../views/index.php");
        exit();
    }
}
?>
