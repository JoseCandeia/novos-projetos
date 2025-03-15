<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação Cliente</title>
    <link rel="stylesheet" href="../assets/css/solicitacao-cliente.css">
</head>
<body>

    <h1>Solicitação</h1>
    <form method="POST" action="solicitacao.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>

        <label for="solicitacao">Solicitação:</label>
        <textarea id="solicitacao" name="solicitacao" required></textarea>

        <button type="submit">Enviar Solicitação</button>
    </form>

</body>
</html>
