<?php

// conexão com o banco de dados.
define('HOST','localhost');
define('USER','root');
define('PASS','12345');
define('BASE', 'cadastro');

$conn = new mysqli(HOST,USER,PASS,BASE);

?>