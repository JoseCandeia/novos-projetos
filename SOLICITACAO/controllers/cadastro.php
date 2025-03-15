<?php
require_once "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
        exit();
    }

    // Verificar se o e-mail já existe no banco de dados
    $sql_check_email = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Este e-mail já está registrado!'); window.history.back();</script>";
        exit();
    }
    $stmt->close();

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, telefone, endereco) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $email, $senha_hash, $data_nascimento, $telefone, $endereco);

    if ($stmt->execute()) {
        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href='../views/index.php';
              </script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
