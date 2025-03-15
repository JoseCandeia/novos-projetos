<?php
session_start();
include("config.php");

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $tipo_usuario = $_POST['tipo_usuario']; // Cliente ou Analista

    // Consultar o banco de dados para verificar se o nome e a senha correspondem ao tipo de usuário
    $sql = "SELECT * FROM usuarios WHERE nome = '{$nome}' AND senha = MD5('{$senha}') AND tipo_usuario = '{$tipo_usuario}'";
    $res = mysqli_query($conn, $sql);

    // Verificar se o usuário existe
    if (mysqli_num_rows($res) > 0) {
        $usuario = mysqli_fetch_assoc($res);

        // Criar a sessão de login
        $_SESSION['logged_in'] = true;
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Guardar o tipo de usuário (cliente ou analista)

        // Redirecionar para a página principal
        header("Location: index.php");
        exit;
    } else {
        $erro = "Nome de usuário, senha ou tipo de usuário incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)) { echo "<div class='alert alert-danger'>$erro</div>"; } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                                <select name="tipo_usuario" class="form-control" required>
                                    <option value="cliente">Cliente</option>
                                    <option value="analista">Analista</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
