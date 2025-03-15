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
            <li class="nome">Bem-vindo, Adm <?php echo $nomeUsuario; ?>!</li> <!-- Exibe o primeiro nome em maiúsculo -->
            <li><a href="../views/adm.php">Início</a></li>
            <li><a href="../views/cadastrar_produto.php">Cadastrar</a></li>
            <li><a href="../views/listar_produtos.php">Listar</a></li>
            <li><a href="../views/responder_solicitacao.php">Solicitações</a></li>
            <li><a href="../HOME/logout.php">Sair</a></li>
        </ul>
        <div class="menu-toggle">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
    </nav>

    
   

    

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
