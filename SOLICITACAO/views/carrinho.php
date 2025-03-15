<?php
session_start();

// Verifica se o carrinho está vazio, se não, cria um array de carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar produto ao carrinho
if (isset($_GET['add'])) {
    $produto_id = $_GET['add'];
    
    // Verifica se o produto já existe no carrinho
    if (!isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id] = 1; // Adiciona o produto com quantidade 1
    } else {
        $_SESSION['carrinho'][$produto_id]++; // Incrementa a quantidade se já estiver no carrinho
    }
}

// Remover um produto (diminuir a quantidade de 1)
if (isset($_GET['remove'])) {
    $produto_id = $_GET['remove'];
    
    // Verifica se o produto existe no carrinho
    if (isset($_SESSION['carrinho'][$produto_id])) {
        // Se a quantidade for maior que 1, diminui a quantidade
        if ($_SESSION['carrinho'][$produto_id] > 1) {
            $_SESSION['carrinho'][$produto_id]--;
        } else {
            // Se a quantidade for 1, remove o produto
            unset($_SESSION['carrinho'][$produto_id]);
        }
    }
}

// Se o carrinho não estiver vazio, fazer a consulta para buscar os produtos
if (!empty($_SESSION['carrinho'])) {
    // Preparando a consulta SQL para obter os produtos que estão no carrinho
    require_once "../config/conexao.php";

    // Criando a lista de IDs dos produtos no carrinho
    $ids_produtos = implode(',', array_keys($_SESSION['carrinho']));

    // Consulta para obter os produtos
    $sql = "SELECT * FROM produtos WHERE id IN ($ids_produtos)";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/mercadinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <!-- Navegação -->
    <nav>
        <ul>
            <li class="nome">Carrinho de Compras</li>
            <li><a href="../HOME/home.php">Início</a></li>
            <li><a href="listar_produtos.php">Produtos</a></li>
            <li><a href="../views/index.php">Sair</a></li>
        </ul>
    </nav>

    <header>
        <div class="container">
            <div class="logo">
                <h1>Mercadinho Online</h1>
            </div>
            <div class="carrinho">
                <a href="carrinho.php">
                    <button>Carrinho</button>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Itens no Carrinho</h2>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <p>Seu carrinho está vazio.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <a href="../HOME/home.php">Voltar</a>
                <tbody>
                    <?php 
                    $total = 0;

                    // Verifica se a consulta retornou resultados
                    if ($result && $result->num_rows > 0):
                        while ($produto = $result->fetch_assoc()):
                            $quantidade = $_SESSION['carrinho'][$produto['id']];
                            $subtotal = $produto['preco'] * $quantidade;
                            $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $quantidade; ?></td>
                        <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                        <td><a href="?remove=<?php echo $produto['id']; ?>"><button>Remover</button></a></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <p>Alguns produtos não foram encontrados no banco de dados.</p>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="total">
                <p>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
                <a href="checkout.php"><button>Finalizar Compra</button></a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mercadinho Online - Todos os direitos reservados</p>
            <a href="https://github.com/JoseCandeia" target="_blank"><img width="48" height="48" src="https://img.icons8.com/color-glass/48/github--v1.png" alt="github--v1"/>GitHub</a>
            <a href="https://www.linkedin.com/in/jos%C3%A9-eduardo-da-silva-candeia-/" target="_blank"><img width="48" height="48" src="https://img.icons8.com/color/48/linkedin.png" alt="linkedin"/>Linkedin</a>
        </div>
    </footer>

</body>
</html>
