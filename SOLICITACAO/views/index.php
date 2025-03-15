<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);  
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../assets/css/index.css"> 
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <form action="../controllers/processar-login.php" method="POST">
     
      <label for="nome">Nome de usuário:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>


      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

      
      <button type="submit">Entrar</button>
    </form>

   
    <p>Não tem conta? <a href="cadastro-usuario.php">Cadastre-se</a></p>
  </div>
</body>
</html>

