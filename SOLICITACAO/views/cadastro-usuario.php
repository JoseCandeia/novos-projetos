<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="../assets/css/cadastro-usuario.css">>
</head>
<body>
  <div class="form-container">
    <h1>Cadastro de Usuário</h1>
   
    <form action="../controllers/cadastro.php" method="POST" >
    
      <label for="nome">Nome Completo:</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>


      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

 
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

     
      <label for="confirmar_senha">Confirmar Senha:</label>
      <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>

      
      <label for="data_nascimento">Data de Nascimento:</label>
      <input type="date" id="data_nascimento" name="data_nascimento" required>

      
      <label for="telefone">Telefone:</label>
      <input type="text" id="telefone" name="telefone" placeholder="Digite seu telefone" required>

  
      <label for="endereco">Endereço:</label>
      <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço" required>

      
      <button type="submit">Cadastrar</button>
    </form>
    <p class="login-link">Já tem uma conta? <a href="../views/index.php">Faça login aqui</a></p>
  </div>
</body>
</html>
