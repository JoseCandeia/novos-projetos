<?php
define('SEVIDOR', 'localhost');
define('USUARIO', 'root');
define('SENHA', '12345');  // Atualize a senha conforme sua configuração
define('BANCO', 'solicitacao'); // Atualize o nome do banco conforme sua configuração

// Criação da conexão
$conn = new mysqli(SEVIDOR, USUARIO, SENHA, BANCO);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
