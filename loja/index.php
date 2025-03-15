<?
require'../loja/conexao/conexao.php';
addItemToCart($pdo, 3, 1);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- TOPO DO SITE -->

    <div class="header">
        <p class="logo">
            Mercadinho
        </p>
        <div class="cart"><i class="fa fa-shopping-cart"></i>
            <p>0</p>
        </div>
    </div>

    <!-- FIM DO SITE -->


    <!-- CORPO DO SITE -->

    <div class="container">

        <!-- LINHA DO PRODUTO -->
        <div class="linha-produtos">

            <!-- INICIO PRODUTO - Chips -->
<form action="" method="POST">
    <div class="corpoProduto">
        <div class="imgProduto">
            <img src="img/chips-160417_640.png" alt="chips" class="produtoMiniatura" />
        </div>
        <div class="titulo">
            <p>Chips</p>
            <h2>R$ 4,80</h2>
            <input type="hidden" name="id_produto" value="1">
            <button type="submit" class="button" name="addcarrinho">Adicionar ao carrinho</button>
        </div>
    </div>
</form>
<!-- FIM PRODUTO -->

<!-- INICIO PRODUTO - Arroz -->
<form action="" method="POST">
    <div class="corpoProduto">
        <div class="imgProduto">
            <img src="img/arroz.png" alt="arroz" class="produtoMiniatura" />
        </div>
        <div class="titulo">
            <p>Arroz</p>
            <h2>R$ 6,90</h2>
            <input type="hidden" name="id_produto" value="2">
            <button type="submit" class="button" name="addcarrinho">Adicionar ao carrinho</button>
        </div>
    </div>
</form>
<!-- FIM PRODUTO -->

<!-- INICIO PRODUTO - Coca Cola -->
<form action="" method="POST">
    <div class="corpoProduto">
        <div class="imgProduto">
            <img src="img/coca.png" alt="coca-cola" class="produtoMiniatura" />
        </div>
        <div class="titulo">
            <p>Coca Cola</p>
            <h2>R$ 7,00</h2>
            <input type="hidden" name="id_produto" value="3">
            <button type="submit" class="button" name="addcarrinho">Adicionar ao carrinho</button>
        </div>
    </div>
</form>
<!-- FIM PRODUTO -->

<!-- INICIO PRODUTO - Cream Cracker -->
<form action="" method="POST">
    <div class="corpoProduto">
        <div class="imgProduto">
            <img src="img/cream_crakcker.png" alt="cream_crakcker" class="produtoMiniatura" />
        </div>
        <div class="titulo">
            <p>Cream Cracker</p>
            <h2>R$ 5,20</h2>
            <input type="hidden" name="id_produto" value="4">
            <button type="submit" class="button" name="addcarrinho">Adicionar ao carrinho</button>
        </div>
    </div>
</form>
<!-- FIM PRODUTO -->



        </div>
        <!-- FIM DA LINHA DO PRODUTO -->

       

        <!-- BARRA LATERAL DO SILE -->
         <div class="barra-lateral">

            <div class="topo-carrinho">
                <p>Meu Carrinho</p>
            </div>

            <!-- INICIO PRODUTO DENTRO DO CARRINHO -->
             <div class="item-carrinho">
                <div class="linha-da-imagem">
                     <img src="img/chips-160417_640.png" alt="" class="img-carrinho">
                </div>

                <p>Chips</p>
                <h2>R$ 4,80</h2>
                <form action="#" method="POST">
                    <input type="hidden" name="id_produto" value="1">
                    <button type="submit"style="border:none; background:none;" ><i class="fa fa-trash-o " ></i></button>
                </form>
             </div>
            <!-- FIM DO PRODUTO DENTRO DO CARRINHO -->

            <!-- INICIO DA COLUNA DO CARRINHO -->
             <div class="item-carrinho-vazio">
                Seu Carrinho Está Vazio!
             </div>
             <div class="rodape">
                <h3>Total</h3>
                <h2>R$4,80</h2>
             </div>
             <!-- FIM DA DA COLUNA DO CARRINHO -->
         </div>
        <!-- FIM DA BARRA LATERAL DO SILE -->
    </div>

    <!-- FIM DO CORPO DO SITE -->
        <script src="script.js"></script> 
</body>

</html>