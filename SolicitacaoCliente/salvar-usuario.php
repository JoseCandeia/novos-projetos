<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $senha = md5($_POST["senha"]);
        $data_nasc = $_POST["data_nasc"];
        $solicitacao = $_POST["solicitacao"];

        // conectando na tabela ou inserindo
        $sql = "INSERT INTO usuarios(nome,email,telefone,senha,data_nasc,solicitacao) VALUES (
        '{$nome}','{$email}','{$telefone}','{$senha}','{$senha}','{$data_nasc}','{$solicitacao}')";

        $res = $conn->query($sql);

        // caso a ação de certo
        if ($res == true) {
            print "<script>alert('Cadastro Realizado com Sucesso!!!')</script>";
            print "<script>location.href='?page=listar'</script>";
        } else {
            print "<script>alert('Não Foi Possível Cadastrar o Usuário.')</script>";
            print "<script>location.href='?page=listar'</script>";
        }

        break;

    case 'editar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $senha = md5($_POST["senha"]);
        $data_nasc = $_POST["data_nasc"];
        $solicitacao = $_POST["solicitacao"];

        //ATUALIZAR A TABELA
       $sql = "UPDATE usuarios SET 
        nome = '{$nome}',
        email = '{$email}',
        telefone = '{$telefone}',
        senha = '{$senha}',
        data_nasc = '{$data_nasc}',
        solicitacao = '{$solicitacao}'
        WHERE id = " . $_REQUEST["id"];


        $res = $conn->query($sql);
        // caso a ação de certo
        if ($res == true) {
            print "<script>alert('Editado com Sucesso!!!')</script>";
            print "<script>location.href='?page=listar'</script>";
        } else {
            print "<script>alert('Não Foi Possível Editar o Usuário.')</script>";
            print "<script>location.href='?page=listar'</script>";
        }
        break;


    case 'excluir':
        // procura dentro da minha tabela o id que eu quero excluir
        $sql = "DELETE FROM usuarios WHERE id=".$_REQUEST["id"];

        $res = $conn->query($sql);
        // caso a ação de certo
        if ($res == true) {
            print "<script>alert('Excluido com Sucesso!!!')</script>";
            print "<script>location.href='?page=listar'</script>";
        } else {
            print "<script>alert('Não Foi Possível Excluir o Usuário.')</script>";
            print "<script>location.href='?page=listar'</script>";
        }
        break;
       
        
        
        

        

}
