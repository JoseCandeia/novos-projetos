<?php
session_start();
include("config.php");

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tipo_usuario = $_POST['tipo_usuario']; // Cliente ou Analista

    // Campos extras para o tipo analista
    $especialidade = isset($_POST['especialidade']) ? mysqli_real_escape_string($conn, $_POST['especialidade']) : null;

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o nome de usuário já existe
    $sql = "SELECT * FROM usuarios WHERE nome = '{$nome}'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $erro = "Nome de usuário já existe. Tente outro.";
    } else {
        // Insere o novo usuário no banco de dados
        if ($tipo_usuario == 'analista') {
            // Insere na tabela analista
            $insert_sql = "INSERT INTO analista (nome, senha, email, tipo_usuario, especialidade) 
                           VALUES ('{$nome}', '{$senha_hash}', '{$email}', '{$tipo_usuario}', '{$especialidade}')";
        } else {
            // Insere na tabela usuario
            $insert_sql = "INSERT INTO usuario (nome, senha, email, tipo_usuario) 
                           VALUES ('{$nome}', '{$senha_hash}', '{$email}', '{$tipo_usuario}')";
        }

        $insert_res = mysqli_query($conn, $insert_sql);

        if ($insert_res) {
            // Redirecionar para a página de login após o cadastro bem-sucedido
            header("Location: login.php");
            exit;
        } else {
            $erro = "Erro ao cadastrar o usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Cadastro de Usuário</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)) { echo "<div class='alert alert-danger'>$erro</div>"; } ?>
                        <?php if (isset($sucesso)) { echo "<div class='alert alert-success'>$sucesso</div>"; } ?>
                        <!-- Formulário de Cadastro -->
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                                <select name="tipo_usuario" class="form-control" required onchange="mostrarCamposExtras(this.value)">
                                    <option value="usuario">Usuário</option>
                                    <option value="analista">Analista</option>
                                </select>
                            </div>

                            <!-- Campos extras para Analista -->
                            <div id="campos_analista" style="display:none;">
                                <div class="mb-3">
                                    <label for="especialidade" class="form-label">Especialidade</label>
                                    <input type="text" class="form-control" name="especialidade" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para exibir ou ocultar campos extras de acordo com o tipo de usuário
        function mostrarCamposExtras(tipo) {
            if (tipo === 'analista') {
                document.getElementById('campos_analista').style.display = 'block';
            } else {
                document.getElementById('campos_analista').style.display = 'none';
            }
        }
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
