<?php
session_start();

// Inicializa o carrinho, se ainda não existir.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/**
 * Calcula a quantidade total de itens e o valor total do carrinho.
 *
 * @param array $cart
 * @return array [itemCount, total]
 */
function calculateCartStats($cart) {
    $itemCount = 0;
    $total = 0;
    foreach ($cart as $item) {
        $itemCount += $item['quantity'];
        $total += $item['price'] * $item['quantity'];
    }
    return [$itemCount, $total];
}

// Processa a requisição: se POST, adiciona ou remove; se GET, apenas retorna os dados.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        // Obtém os dados do produto
        $id = $_POST['id_produto'] ?? '';
        $name = $_POST['nome_produto'] ?? '';
        $price = isset($_POST['preco_produto']) ? floatval($_POST['preco_produto']) : 0;
        
        // Verifica se o produto já existe no carrinho. Se sim, incrementa a quantidade.
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $id) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }
        // Se não existe, adiciona com quantidade 1.
        if (!$found) {
            $_SESSION['cart'][] = [
                'id'       => $id,
                'name'     => $name,
                'price'    => $price,
                'quantity' => 1
            ];
        }
    } elseif ($action === 'remove') {
        // Remove o item cujo ID foi enviado.
        $id = $_POST['id_produto'] ?? '';
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($id) {
            return $item['id'] !== $id;
        });
        // Reindexa o array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    
    list($itemCount, $total) = calculateCartStats($_SESSION['cart']);
    
    // Retorna os dados do carrinho em JSON.
    header('Content-Type: application/json');
    echo json_encode([
        'success'   => true,
        'cart'      => $_SESSION['cart'],
        'itemCount' => $itemCount,
        'total'     => $total
    ]);
    exit;
} else {
    // Para requisições GET, retorna os dados atuais do carrinho.
    list($itemCount, $total) = calculateCartStats($_SESSION['cart']);
    
    header('Content-Type: application/json');
    echo json_encode([
        'cart'      => $_SESSION['cart'],
        'itemCount' => $itemCount,
        'total'     => $total
    ]);
    exit;
}
