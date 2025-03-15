
<!-- parte do html -->

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    
    <!--NAVBAR  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fa-regular fa-circle-user "></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cart/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=novo">Novo Usuário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=listar">Lista usuário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=solicitacao-usuario">Solicitação</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!--FIM DA NAVBAR  -->

 <!-- FORMULARIO -->

 <!-- CODIGO EM PHP -->

<div class="container">
<div class="row">
  <div class="col mt-5" >
    
  <?php
   
   include("config.php");
switch (@$_REQUEST["page"]){
 
    case "novo":
      include("novo-usuario.php");
      break;
        case "salvar";
        include("salvar-usuario.php");
        break;

        default:
        
        print "<h1>Boas Vindas!</h1>";
}

?>


  </div>
</div>
</div>



 <!-- Fim do codigo em php -->

  <!-- FIM DO FORMULARIO -->


    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>