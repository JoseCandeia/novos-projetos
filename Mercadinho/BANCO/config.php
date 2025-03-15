<?php

$dbHost = 'Localhost';
$dbUsername ='root';
$dbPassword = '12345';
$dbName = 'solicitacao-cliente';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);


// if($conexao->connect_errno){

//     echo ("Erro");
// }else{

//     echo ("Conexão efetuada com sucesso");
// }



?>