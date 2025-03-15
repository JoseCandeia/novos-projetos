<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php
session_start(); 

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redireciona para o login caso não esteja logado
    exit;
}

// Recupera o nome do usuário da sessão
$nome_usuario = $_SESSION['nome'];
?>
<!-- navBar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Cadastro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
<!-- Fim da navBar -->

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
      case "listar":
        include("listar-usuario.php");
        break;

        case "salvar":
          include("salvar-usuario.php");
          break;
          case "editar":
            include("editar-usuario.php");
            break;
            case "solicitacao-usuario":
              include("solicitacao-usuario.php");
              break;
        default:
        
        print "<h1>Boas Vindas, {$nome_usuario}!</h1>";
}

?>
  </div>
</div>
</div>


 <!-- Fim do codigo em php -->


    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>