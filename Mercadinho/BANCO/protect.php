<?php


if (!isset($_SESSION['id'])) {
   
    die("Você não pode acessar esta página porque não está logado. <p><a href='../LOGIN/login.php'>Entrar</a></p>");
}
?>
