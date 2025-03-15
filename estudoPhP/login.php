<?php
require_once("conexao.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

 
    if (empty($email) || empty($senha)) {
        echo "Preencha todos os campos!";
        exit;
    }

    
    $sql = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
       header('location: home.php');
    } else {
        echo "E-mail ou senha incorretos.";
    }

    

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <fieldset class="container">
            <legend>Login</legend>
            <label class="nomes" for="email">Email:</label>
            <input class="menu" type="email" name="email" id="email" placeholder="Digite seu email" required><br><br>
            <label class="nomes" for="senha">Senha:</label>
            <input class="menu" type="password" name="senha" id="senha" placeholder="Digite sua senha" required><br><br>
            <input class="btn" type="submit" name="enviar" id="envia" value="Entrar">
        </fieldset>
    </form>
</body>

</html>

