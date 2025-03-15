<nav>
  <ul>
  <li class="nome">Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</li>
    <li><a href="home.php">Início</a></li>
    <li><a href="perfil.php">Meu Perfil</a></li>
    <li><a href="../views/cadastrar_produto.php">Cadastrar</a></li>
    <li><a href="../views/listar_produtos.php">Listar</a></li>
    <li><a href="../HOME/logout.php">Sair</a></li>
    <div class="menu-toggle">
    <i class="fa fa-bars" aria-hidden="true"></i> 
  </div>
  </ul>
 
</nav>