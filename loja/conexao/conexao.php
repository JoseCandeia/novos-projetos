<?php
// Configurações de conexão (ajuste os valores conforme seu ambiente)
$host = 'localhost';
$dbname = 'loja';
$username = 'root';
$password = '12345';

// Cria a conexão usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}

/**
 * Adiciona um item ao carrinho.
 *
 * Se o item já existir na tabela 'carrinho' (com base no id_produto),
 * a função atualiza a quantidade; caso contrário, insere um novo registro.
 *
 * @param PDO    $pdo        Conexão PDO ativa
 * @param mixed  $id_produto Identificador do produto
 * @param int    $quantidade Quantidade a ser adicionada
 */
function addItemToCart(PDO $pdo, $id_produto, $quantidade = 1) {
    // Verifica se o produto já está no carrinho
    $stmt = $pdo->prepare("SELECT quantidade FROM carrinho WHERE id_produto = :id_produto");
    $stmt->execute([':id_produto' => $id_produto]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Se já existe, atualiza a quantidade
        $newQuantity = $row['quantidade'] + $quantidade;
        $updateStmt = $pdo->prepare("UPDATE carrinho SET quantidade = :quantidade WHERE id_produto = :id_produto");
        $updateStmt->execute([
            ':quantidade' => $newQuantity,
            ':id_produto' => $id_produto
        ]);
    } else {
        // Caso contrário, insere um novo item
        $insertStmt = $pdo->prepare("INSERT INTO carrinho (id_produto, quantidade) VALUES (:id_produto, :quantidade)");
        $insertStmt->execute([
            ':id_produto' => $id_produto,
            ':quantidade' => $quantidade
        ]);
    }
}

/**
 * (Opcional) Remove um item do carrinho.
 *
 * @param PDO   $pdo        Conexão PDO ativa
 * @param mixed $id_produto Identificador do produto a ser removido
 */
function removeItemFromCart(PDO $pdo, $id_produto) {
    $stmt = $pdo->prepare("DELETE FROM carrinho WHERE id_produto = :id_produto");
    $stmt->execute([':id_produto' => $id_produto]);
}

/* 
Exemplo de uso:
  
// Para adicionar 1 unidade do produto com id 1:
addItemToCart($pdo, 1, 1);

// Para remover o produto com id 1 do carrinho:
// removeItemFromCart($pdo, 1);
*/
?>
