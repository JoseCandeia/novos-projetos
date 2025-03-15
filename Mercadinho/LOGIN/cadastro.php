






<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../CSS/cadastro.css">
</head>
<body>
    
    <form action="" onsubmit="cadastro(event)">
        <h2>Cadastrar-se</h2>
        <label class="i" for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite seu Nome...">

        <label for="nome">Data de Nascimento:</label>
        <input type="date" name="data_nasc" id="data_nasc" placeholder="Digite seu ano...">

        <label for="nome">Email:</label>
        <input type="email" name="email" id="email" placeholder="Informe seu E-mail...">


        <label for="nome">Telefone:</label>
        <input type="tel" name="telefone" id="telefone" placeholder="Digite seu Telefone...">

    
        <label for="genero">Genero:</label>
        <label for="feminino">Feminino</label>
        <input type="radio" name="genero" id="feminino">

        <label for="masculino">Masculino</label>
        <input type="radio" name="genero" id="masculino">

        <label for="outros">Outros</label>
        <input type="radio" name="genero" id="outros">

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" placeholder="Digite seu Engereço...">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha"placeholder="Digite sua Senha...">
        
        <label for="senha">Confirma Senha:</label >
        <input type="password" name="senha" id="senha" placeholder="Confirme a Senha...">
            <input type="submit" value="Cadastrar" onclick="cadastro()">

    </form>

    <div id="check-box-retorno">
        <p id="p">CADASTRO REALIZADO COM SUCESSO!</p>
        <button id="btn" onclick="confirm()">OK</button >
    </div>

    <script src="../JS/cadastro.js"></script>
</body>
</html>