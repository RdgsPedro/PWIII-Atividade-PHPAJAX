<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: index.html");
  exit;
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Início</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
  <main>
    <aside class="container__barra-lateral">
      <div class="cabecalho-barra-lateral">
        <div class="avatar-usuario">
          <img
            src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'https://cdn-icons-png.freepik.com/512/64/64572.png'; ?>"
            alt="Foto do usuário">
        </div>
        <div>
          <h2><?php echo htmlspecialchars($usuario['nome']); ?></h2>
          <p class="subtitulo">Bem-vindo ao seu painel</p>
        </div>
      </div>

      <nav class="menu-barra-lateral">
        <a href="#" class="item-menu ativo">
          <i class="fas fa-home"></i>
          <span>Início</span>
        </a>
        <a href="contatos.php" class="item-menu">
          <i class="fas fa-user-circle"></i>
          <span>Contatos</span>
        </a>
      </nav>

      <div class="rodape-barra-lateral">
        <a href="logout.php" class="botao-sair">
          <i class="fas fa-sign-out-alt"></i>
          <span>Sair</span>
        </a>
      </div>
    </aside>

    <section class="container__formulario">
      <div class="cabecalho-pagina">
        <h1>Tela Inicial</h1>
        <p class="texto-boas-vindas">Gerencie suas informações pessoais e preferências</p>
      </div>

      <div class="cartao-perfil">
        <div class="imagem-perfil">
          <img
            src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'https://via.placeholder.com/150'; ?>"
            alt="Foto do usuário">
        </div>
        <h2 class="nome-perfil"><?php echo htmlspecialchars($usuario['nome']); ?></h2>
      </div>

      <div class="cartao-dados">
        <h3>Informações Pessoais</h3>

        <div class="item-dado">
          <div class="icone-dado">
            <i class="fas fa-user"></i>
          </div>
          <div class="conteudo-dado">
            <div class="rotulo-dado">Login</div>
            <div class="valor-dado"><?php echo htmlspecialchars($usuario['login']); ?></div>
          </div>
        </div>

        <div class="item-dado">
          <div class="icone-dado">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="conteudo-dado">
            <div class="rotulo-dado">Email</div>
            <div class="valor-dado"><?php echo htmlspecialchars($usuario['email']); ?></div>
          </div>
        </div>

        <div class="item-dado">
          <div class="icone-dado">
            <i class="fas fa-phone"></i>
          </div>
          <div class="conteudo-dado">
            <div class="rotulo-dado">Telefone</div>
            <div class="valor-dado"><?php echo htmlspecialchars($usuario['telefone']); ?></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    $(document).ready(function () {
      $('.item-menu').on('click', function () {
        $('.item-menu').removeClass('ativo');
        $(this).addClass('ativo');
      });
    });
  </script>
</body>

</html>