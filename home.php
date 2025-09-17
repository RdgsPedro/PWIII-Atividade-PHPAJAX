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
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <style>
    :root {
      --cor-primaria: #123d70;
      --cor-secundaria: #0d2c54;
      --cor-destaque: #4a86e8;
      --cor-clara: #FFFAFA;
      --cor-texto: #333;
      --cor-texto-claro: #666;
      --sombra: 0 4px 12px rgba(0, 0, 0, 0.1);
      --transicao: all 0.3s ease;
    }

    html,
    body {
      height: 100%;
      font-family: "Sora", sans-serif;
      background-color: #f0f2f5;
    }

    .layout-principal {
      min-height: 100vh;
      display: flex;
      overflow: hidden;
      box-shadow: var(--sombra);
    }

    .container__barra-lateral {
      width: 280px;
      min-height: 100vh;
      padding: 30px 20px;
      background: linear-gradient(to bottom, var(--cor-primaria), var(--cor-secundaria));
      color: var(--cor-clara);
      display: flex;
      flex-direction: column;
      position: relative;
      transition: var(--transicao);
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .container__formulario {
      flex: 1;
      padding: 40px;
      overflow-y: auto;
      background: transparent;
    }

    .cabecalho-barra-lateral {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 40px;
    }

    .avatar-usuario {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
      border: 3px solid var(--cor-clara);
      background-color: var(--cor-clara);
      margin-bottom: 15px;
      box-shadow: var(--sombra);
    }

    .avatar-usuario img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .cabecalho-barra-lateral h2 {
      font-size: 20px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 5px;
      color: var(--cor-clara);
    }

    .subtitulo {
      font-size: 14px;
      opacity: 0.85;
      text-align: center;
      color: var(--cor-clara);
    }

    .menu-barra-lateral {
      flex-grow: 1;
      margin-top: 8px;
    }

    .item-menu {
      display: flex;
      align-items: center;
      padding: 12px 15px;
      margin-bottom: 8px;
      border-radius: 8px;
      color: var(--cor-clara);
      text-decoration: none;
      transition: var(--transicao);
      cursor: pointer;
    }

    .item-menu i {
      margin-right: 12px;
      font-size: 18px;
      width: 24px;
      text-align: center;
    }

    .item-menu:hover {
      background-color: rgba(255, 255, 255, 0.1);
      text-decoration: none;
    }

    .item-menu.ativo {
      background-color: var(--cor-destaque);
    }

    .rodape-barra-lateral {
      margin-top: auto;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .botao-sair {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 12px;
      background-color: var(--cor-clara);
      border-radius: 8px;
      color: var(--cor-primaria);
      font-weight: 600;
      text-decoration: none;
      transition: var(--transicao);
      box-shadow: var(--sombra);
    }

    .botao-sair:hover {
      background-color: #e8e8e8;
      transform: translateY(-2px);
    }

    .botao-sair i {
      margin-right: 8px;
    }

    .cartao-perfil,
    .cartao-dados {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: var(--sombra);
      margin-bottom: 30px;
    }

    .imagem-perfil {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      overflow: hidden;
      background-color: var(--cor-primaria);
      margin-bottom: 20px;
    }

    .imagem-perfil img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .nome-perfil {
      font-size: 22px;
      font-weight: 600;
      color: var(--cor-primaria);
      margin-bottom: 5px;
    }

    .cartao-dados h3 {
      color: var(--cor-primaria);
      font-size: 20px;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }

    .item-dado {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .item-dado:last-child {
      margin-bottom: 0;
    }

    .icone-dado {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: rgba(74, 134, 232, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      color: var(--cor-destaque);
      font-size: 18px;
    }

    .rotulo-dado {
      font-size: 14px;
      color: var(--cor-texto-claro);
      margin-bottom: 4px;
    }

    .valor-dado {
      font-size: 16px;
      color: var(--cor-texto);
      font-weight: 500;
    }
  </style>
</head>

<body>
  <div class="layout-principal">
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
        <a href="#" class="item-menu ativo d-flex align-items-center">
          <i class="fas fa-home"></i>
          <span>Início</span>
        </a>
        <a href="contatos.php" class="item-menu d-flex align-items-center">
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
      <div class="cabecalho-pagina mb-4">
        <h1 style="color:var(--cor-primaria); font-size:28px; font-weight:700;">Tela Inicial</h1>
        <p class="texto-boas-vindas" style="color:var(--cor-texto-claro); font-size:16px;">Gerencie suas informações
          pessoais e preferências</p>
      </div>

      <div class="cartao-perfil text-center">
        <div class="imagem-perfil mx-auto">
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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