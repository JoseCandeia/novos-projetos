<?php

$usuario = 'root';
$senha = '12345';
$database = 'solicitacao-cliente';
$host = 'localhost';

$mysqli = new mysqli($host,$usuario,$senha,$database);

if($mysqli->error){
    die("falha ao conectar ao banco de dados" . $mysqli->error);
}

?>