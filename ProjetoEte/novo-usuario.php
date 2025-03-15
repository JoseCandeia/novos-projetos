<h1>CADASTRAR-SE</h1>

<h2>Novo Usuário</h2>
<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>Telefone:</label>
        <input type="tel" name="telefone" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>Solicitação:</label>
        <input type="text" name="solicitcao" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
