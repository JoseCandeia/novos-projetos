<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/index.php");
    exit();
}

require_once "../config/conexao.php"; // Conexão com o banco de dados

// Consulta SQL para obter todos os produtos
$sql = "SELECT * FROM produtos";  
$result = $conn->query($sql);  // Executa a consulta no banco de dados

// Verifica se houve erro na consulta
if (!$result) {
    echo "Erro ao carregar os produtos: " . $conn->error;
    exit();
}

// Adicionar ao carrinho
if (isset($_GET['add_to_cart'])) {
    $produto_id = $_GET['add_to_cart'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifica se o produto já existe no carrinho
    if (isset($_SESSION['carrinho'][$produto_id])) {
        // Se o produto já existe, incrementa a quantidade
        $_SESSION['carrinho'][$produto_id]++;
    } else {
        // Caso contrário, adiciona o produto com quantidade 1
        $_SESSION['carrinho'][$produto_id] = 1;
    }

    // Redireciona para a home com a mensagem de sucesso
    header("Location: home.php?added=true");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadinho Online</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/mercadinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Link para Font Awesome -->
</head>
<body>
    <!-- Navegação -->
    <nav>
        <ul>
            <?php
            // Pega o nome do usuário da sessão, divide e coloca o primeiro nome em maiúsculo
            $nomeUsuario = ucfirst(explode(' ', $_SESSION['usuario'])[0]);
            ?>
            <li class="nome">Bem-vindo, <?php echo $nomeUsuario; ?>!</li> <!-- Exibe o primeiro nome em maiúsculo -->
            <li><a href="home.php">Início</a></li>
            <li><a href="../views/solicitacao-cliente.php">Solicite aqui</a></li>
            <li><a href="../views/visualizar_resposta.php">Suas Solicitações</a></li>
            <li><a href="../HOME/logout.php">Sair</a></li>
        </ul>
        <div class="menu-toggle">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
    </nav>

    <!-- MERCADINHO -->
    <header>
        <div class="container">
            <div class="logo">
                <h1>Mercadinho Online</h1>
            </div>
            <div class="carrinho">
                <a href="../views/carrinho-cliente.php">
                    <button>
                        Carrinho
                        <!-- Exibe a quantidade de itens no carrinho -->
                        <?php if (isset($_SESSION['carrinho'])): ?>
                            <span class="carrinho-quantidade">(<?php echo array_sum($_SESSION['carrinho']); ?>)</span>
                        <?php endif; ?>
                    </button>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Produtos</h2>
        <div class="produtos">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($produto = $result->fetch_assoc()): ?>
                    <div class="produto">
                        <!-- Verifica se a imagem existe -->
                        <img src="../uploads/<?php echo isset($produto['imagem']) && file_exists("../uploads/" . $produto['imagem']) ? $produto['imagem'] : 'default.png'; ?>" 
                             alt="<?php echo $produto['nome']; ?>" class="produto-imagem">
                        <h3><?php echo $produto['nome']; ?></h3>
                        <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <p><?php echo $produto['descricao']; ?></p>
                        <button class="adicionar" onclick="confirmAddToCart(<?php echo $produto['id']; ?>)">Adicionar ao Carrinho</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Não há produtos cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mensagem de sucesso -->
    <?php if (isset($_GET['added'])): ?>
        <div class="msg-sucesso">
            <p>Produto adicionado ao carrinho com sucesso!</p>
        </div>
    <?php endif; ?>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mercadinho Online - Todos os direitos reservados</p>
            <a href="https://github.com/JoseCandeia" target="_blank" > <img width="48" height="48" src="https://img.icons8.com/color-glass/48/github--v1.png" alt="github--v1"/>GitHub</a>
            <a href="https://www.linkedin.com/in/jos%C3%A9-eduardo-da-silva-candeia-/" target="_blank"><img width="48" height="48" src="https://img.icons8.com/color/48/linkedin.png" alt="linkedin"/>Linkedin</a>
        </div>
    </footer>

    <script>
        // Função para o menu responsivo
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            navUl.classList.toggle('show');
        });

        // Função para confirmar antes de adicionar ao carrinho
        function confirmAddToCart(productId) {
            const confirmation = confirm("Você realmente deseja adicionar este produto ao carrinho?");
            if (confirmation) {
                window.location.href = `home.php?add_to_cart=${productId}`;
            }
        }
    </script>
</body>
</html>
