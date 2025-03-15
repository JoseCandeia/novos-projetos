<h1>Listar Usuários</h1>
<?php
    // consulta na tabela usuarios
    $sql = "SELECT * FROM usuarios";
    $res= $conn->query($sql);

    //pegarar o numero de linhas
    $quant = $res->num_rows;

    //para pegar os usuarios
    if ($quant > 0) {
        print"<table class='table table-hover  table-striped table-bordered '>";
        print "<tr>";
        print "<th>Id</th>";
        print "<th>Nome</th>";
        print "<th>E-mail</th>";
        print "<th>Solicitação</th>";
        print "<th>Ações</th>";
        print "</tr>";
       while($row = $res->fetch_object()){
        print "<tr>";
        print "<td>". $row->id."</td>";
        print "<td>".$row->nome."</td>";
        print "<td>".$row->email."</td>";
        print "<td>". $row->solicitacao."</td>";
        print "<td>
                <button onclick=\"location.href='?page=editar&id=" . $row->id . "';\" class='btn btn-success'>Editar</button>
                <button onclick=\"if(confirm('Tem Certeza que Deseja Excluir?')){location.href='?page=salvar&acao=excluir&id=" . $row->id . "';}else{false;}\" class='btn btn-danger'>Excluir</button>
                    </td>";
        print "</tr>";
       }
       print"</table>";
    }else{
        print("<p class='alert alert-danger' >Nenhum Resultado Encotrando!</p>");
    }

?>