<?php



// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redirecionar para a página de login
    exit;
}

$usuario_id = $_SESSION['id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Se for um cliente, ele só pode editar sua própria solicitação
if ($tipo_usuario == 'cliente') {
    if (isset($_POST["solicitacao"])) {
        $solicitacao = mysqli_real_escape_string($conn, $_POST["solicitacao"]);

        // Atualizar a solicitação do cliente
        $update_sql = "UPDATE usuarios SET solicitacao = '{$solicitacao}' WHERE id = {$usuario_id}";
        $update_res = mysqli_query($conn, $update_sql);

        if ($update_res) {
            echo "<script>alert('Solicitação Atualizada com Sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao atualizar a solicitação.');</script>";
        }
    }

    // Obter a solicitação do cliente
    $sql = "SELECT solicitacao FROM usuarios WHERE id = {$usuario_id}";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $solicitacao = $user['solicitacao'] ?? '';
} else {
    // Se for analista, ele pode visualizar a solicitação de qualquer usuário
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $sql = "SELECT solicitacao FROM usuarios WHERE id = {$id}";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $solicitacao = $user['solicitacao'] ?? '';
    }
}

// Se for analista, mostrar todos os usuários
if ($tipo_usuario == 'analista') {
    $sql_usuarios = "SELECT id, nome FROM usuarios WHERE tipo_usuario = 'cliente'";
    $result_usuarios = mysqli_query($conn, $sql_usuarios);
}
?>

<h1>Solicitação do Usuário</h1>

<?php if ($tipo_usuario == 'cliente') { ?>
    <form method="POST">
        <div class="mb-3">
            <label for="solicitacao" class="form-label">Sua Solicitação:</label>
            <textarea name="solicitacao" class="form-control" rows="4"><?php echo $solicitacao; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
<?php } else { ?>
    <form method="POST">
        <label for="id">Selecione um Cliente:</label>
        <select name="id" class="form-control" onchange="this.form.submit()">
            <option value="">Escolha um cliente</option>
            <?php while ($row = mysqli_fetch_assoc($result_usuarios)) { ?>
                <option value="<?php echo $row['id']; ?>" <?php echo (isset($_POST['id']) && $_POST['id'] == $row['id']) ? 'selected' : ''; ?>>
                    <?php echo $row['nome']; ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <?php if (isset($solicitacao)) { ?>
        <div class="mt-3">
            <strong>Solicitação:</strong>
            <p><?php echo $solicitacao; ?></p>
        </div>
    <?php } ?>
<?php } ?>
