<h1>Editar Usuário</h1>

<?php
    // para selecionar todos da tabela
    $sql = "SELECT * FROM usuarios WHERE id=".$_REQUEST["id"];
        $res = $conn->query($sql);
        //É um arry de obejtos
        $row = $res->fetch_object();

?>
<form action="?page=salvar" method="POST">


    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php print $row->id; ?>">


    <div class="mb-3">
        <label >Nome:</label>
        <input type="text" name="nome" class="form-control" value="<?php print $row-> nome;?>">
    </div>
    <div class="mb-3">
        <label >E-mail</label>
        <input type="email" name="email" class="form-control" value="<?php print $row-> email;?>">
    </div>
    <div class="mb-3">
        <label >Telefone:</label>
        <input type="tel" name="telefone" class="form-control" value="<?php print $row->telefone;?>">
    </div>
    <div class="mb-3">
        <label >Senha:</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <div class="mb-3">
        <label >Data De Nascimento:</label>
        <input type="date" name="data_nasc" class="form-control"value="<?php print $row-> data_nasc;?>">
    </div>
    <div class="mb-3">
        <label >Escreva Sua Solicitação:</label>
        <textarea type="textarea" name="solicitacao" class="form-control" value="<?php print $row-> solicitacao;?>"></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>


</form>