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
  <title>Home</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <main>
    <!-- Lado esquerdo -->
    <section class="container__logo">
      <div class="box__logo">
        <h2>Olá, <?php echo htmlspecialchars($usuario['nome']); ?> 👋</h2>
        <p class="subtitulo">Bem-vindo ao seu painel</p>
      </div>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </section>

    <!-- Lado direito -->
    <section class="container__form">
      <h1>Seus dados</h1>
      <div class="perfil">
        <div class="foto-icon with-image">
          <img src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'https://via.placeholder.com/150'; ?>" alt="Foto do usuário">
        </div>
        <p class="foto-texto">Perfil de <?php echo htmlspecialchars($usuario['nome']); ?></p>
      </div>
      
      <div class="dados">
        <p><i class="fas fa-user"></i> <strong>Login:</strong> <?php echo htmlspecialchars($usuario['login']); ?></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['telefone']); ?></p>
      </div>
    </section>
  </main>
</body>
</html>
