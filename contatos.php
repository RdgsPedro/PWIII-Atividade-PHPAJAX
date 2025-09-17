<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: index.html");
  exit;
}
$usuario = $_SESSION['usuario'];

function listarContatos()
{
  include "conecta.php";

  $stmt = $conn->query("SELECT * FROM tb_contato");

  if ($stmt && $stmt->rowCount() > 0) {
    echo "<div class='container-contatos row'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class='cartao-contato col-md-4 mb-4'>";
      echo "<div class='card'>";
      echo "<div class='card-header bg-primary text-white'><h5>" . htmlspecialchars($row['nome']) . "</h5></div>";
      echo "<div class='card-body text-center'>";

      $foto = !empty($row['foto']) ? htmlspecialchars($row['foto']) : 'https://cdn-icons-png.freepik.com/512/64/64572.png';
      echo "<img src='{$foto}' alt='Foto de " . htmlspecialchars($row['nome']) . "' class='rounded-circle mb-3' width='100' height='100'>";

      echo "<p><strong>Login:</strong> " . htmlspecialchars($row['login']) . "</p>";
      echo "<p><strong>Senha:</strong> " . htmlspecialchars($row['senha']) . "</p>";
      echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
      echo "<p><strong>Telefone:</strong> " . htmlspecialchars($row['telefone']) . "</p>";

      echo "</div>";
      echo "<div class='card-footer d-flex justify-content-between'>";
      echo "<button class='btn btn-warning botao-editar' 
                data-id='" . htmlspecialchars($row['id']) . "' 
                data-nome='" . htmlspecialchars($row['nome']) . "' 
                data-login='" . htmlspecialchars($row['login']) . "' 
                data-email='" . htmlspecialchars($row['email']) . "' 
                data-telefone='" . htmlspecialchars($row['telefone']) . "' 
                data-senha='" . htmlspecialchars($row['senha']) . "' 
                data-foto='" . htmlspecialchars($row['foto']) . "'>
                <i class='fas fa-edit'></i> Editar
              </button>";
      echo "<button class='btn btn-danger botao-excluir' data-id='" . htmlspecialchars($row['id']) . "'>
                <i class='fas fa-trash'></i> Excluir
              </button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<p class='text-center text-muted mt-4'>Nenhum contato encontrado.</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Contatos</title>
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
      display: flex;
      min-height: 100vh;
      overflow: hidden;
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

    .container__formulario {
      flex: 1;
      padding: 40px;
      overflow-y: auto;
    }

    .cartao-contato .card {
      box-shadow: var(--sombra);
      border-radius: 12px;
    }

    .cartao-contato .card-header {
      font-weight: 600;
    }

    .cartao-contato img {
      object-fit: cover;
      border-radius: 50%;
    }

    .modal-img-preview {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
      margin: auto;
    }

    .invalid-feedback {
      display: block;
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
        <h2><?php echo htmlspecialchars($usuario['nome']); ?></h2>
        <p class="subtitulo">Lumiere</p>
      </div>
      <nav class="menu-barra-lateral">
        <a href="home.php" class="item-menu d-flex align-items-center">
          <i class="fas fa-home"></i><span>Início</span>
        </a>
        <a href="#" class="item-menu ativo d-flex align-items-center">
          <i class="fas fa-user-circle"></i><span>Contatos</span>
        </a>
      </nav>
      <div class="rodape-barra-lateral">
        <a href="logout.php" class="botao-sair d-flex align-items-center justify-content-center">
          <i class="fas fa-sign-out-alt"></i> Sair
        </a>
      </div>
    </aside>

    <main class="container__formulario">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Contatos</h1>
        <button class="btn btn-primary" id="botaoAdicionar"><i class="fas fa-plus"></i> Adicionar Contato</button>
      </div>
      <?php listarContatos(); ?>
    </main>
  </div>

  <div class="modal fade" id="modalContato" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Adicionar Contato</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="formContato" enctype="multipart/form-data">
            <div class="text-center mb-3">
              <img id="imagemPreview" src="" alt="Preview" class="modal-img-preview mb-2" style="display:none;">
              <input type="file" id="imagemInput" accept="image/*" class="form-control mb-2">
              <small id="fotoTexto" class="text-muted">Clique para adicionar uma foto</small>
            </div>
            <div class="mb-3">
              <label>Nome</label>
              <input type="text" class="form-control" id="nome">
              <div class="invalid-feedback" id="erroNome"></div>
            </div>
            <div class="mb-3">
              <label>Login</label>
              <input type="text" class="form-control" id="login">
              <div class="invalid-feedback" id="erroLogin"></div>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" class="form-control" id="email">
              <div class="invalid-feedback" id="erroEmail"></div>
            </div>
            <div class="mb-3">
              <label>Telefone</label>
              <input type="text" class="form-control" id="telefone">
              <div class="invalid-feedback" id="erroTelefone"></div>
            </div>
            <div class="mb-3">
              <label>Senha</label>
              <input type="password" class="form-control" id="senha">
              <div class="invalid-feedback" id="erroSenha"></div>
              <div class="progress mt-1">
                <div id="barraForcaSenha" class="progress-bar" style="width:0%;"></div>
              </div>
            </div>
            <div class="mb-3">
              <label>Confirmar Senha</label>
              <input type="password" class="form-control" id="confirmarSenha">
              <div class="invalid-feedback" id="erroConfirmarSenha"></div>
              <div class="progress mt-1">
                <div id="barraForcaConfirmar" class="progress-bar" style="width:0%;"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="botaoSalvar"><i class="fas fa-save"></i> Salvar</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
      let editandoId = null;
      const modal = new bootstrap.Modal(document.getElementById('modalContato'));

      $("#botaoAdicionar").click(function () {
        editandoId = null;
        $("#formContato")[0].reset();
        $("#imagemPreview").hide();
        $("#fotoTexto").text("Clique para adicionar uma foto");
        $(".modal-title").text("Adicionar Contato");
        modal.show();
      });

      $(document).on('click', '.botao-editar', function () {
        editandoId = $(this).data('id');
        $(".modal-title").text("Editar Contato");
        $("#nome").val($(this).data('nome'));
        $("#login").val($(this).data('login'));
        $("#email").val($(this).data('email'));
        $("#telefone").val($(this).data('telefone'));
        $("#senha").val($(this).data('senha'));
        $("#confirmarSenha").val($(this).data('senha'));

        const foto = $(this).data('foto');
        if (foto) {
          $("#imagemPreview").attr("src", foto).show();
          $("#fotoTexto").text("Foto carregada");
        } else {
          $("#imagemPreview").hide();
          $("#fotoTexto").text("Clique para adicionar uma foto");
        }
        modal.show();
      });

      $(document).on('click', '.botao-excluir', function () {
        const id = $(this).data('id');
        if (confirm("Deseja realmente excluir este contato?")) {
          $.post("excluir.php", { campo0: id }, function () { location.reload(); });
        }
      });

      $("#imagemInput").change(function () {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            $("#imagemPreview").attr("src", e.target.result).show();
            $("#fotoTexto").text("Foto adicionada com sucesso!");
          }
          reader.readAsDataURL(this.files[0]);
        }
      });

      function calcularForca(senha) {
        let forca = 0;
        if (senha.length >= 8) forca += 20;
        if (/[A-Z]/.test(senha)) forca += 20;
        if (/[a-z]/.test(senha)) forca += 20;
        if (/[0-9]/.test(senha)) forca += 20;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(senha)) forca += 20;
        return forca;
      }

      function atualizarBarra(barra, forca) {
        barra.width(forca + "%");
        barra.removeClass("bg-danger bg-warning bg-success");
        if (forca < 40) barra.addClass("bg-danger");
        else if (forca < 80) barra.addClass("bg-warning");
        else barra.addClass("bg-success");
      }

      $("#senha").on("input", function () { atualizarBarra($("#barraForcaSenha"), calcularForca($(this).val())); });
      $("#confirmarSenha").on("input", function () { atualizarBarra($("#barraForcaConfirmar"), calcularForca($(this).val())); });

      $("#telefone").on("input", function () {
        let v = $(this).val().replace(/\D/g, '');
        if (v.length > 2) v = `(${v.substring(0, 2)}) ${v.substring(2)}`;
        if (v.length > 10) v = `${v.substring(0, 10)}-${v.substring(10, 14)}`;
        $(this).val(v);
      });

      function validarFormulario() {
        let valido = true;
        $(".form-control").removeClass("is-invalid");

        const nome = $("#nome").val().trim();
        if (!nome) { $("#nome").addClass("is-invalid"); $("#erroNome").text("Por favor, insira seu nome."); valido = false; }

        const login = $("#login").val().trim();
        if (!login) { $("#login").addClass("is-invalid"); $("#erroLogin").text("Por favor, insira seu login."); valido = false; }

        const email = $("#email").val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) { $("#email").addClass("is-invalid"); $("#erroEmail").text("E-mail inválido."); valido = false; }

        const telefone = $("#telefone").val().replace(/\D/g, '');
        if (telefone.length < 10) { $("#telefone").addClass("is-invalid"); $("#erroTelefone").text("Telefone inválido."); valido = false; }

        const senha = $("#senha").val();
        const confirmar = $("#confirmarSenha").val();
        if (senha !== confirmar || senha.length === 0) {
          $("#senha,#confirmarSenha").addClass("is-invalid");
          $("#erroSenha").text("As senhas não coincidem ou estão vazias.");
          $("#erroConfirmarSenha").text("As senhas não coincidem ou estão vazias.");
          valido = false;
        }

        return valido;
      }

      $("#botaoSalvar").click(function (e) {
        e.preventDefault();
        if (validarFormulario()) {
          const formData = new FormData();
          formData.append("campo0", editandoId);
          formData.append("campo1", $("#nome").val());
          formData.append("campo2", $("#login").val());
          formData.append("campo3", $("#senha").val());
          formData.append("campo4", $("#email").val());
          formData.append("campo5", $("#telefone").val());
          if ($("#imagemInput")[0].files.length > 0) formData.append("campo6", $("#imagemInput")[0].files[0]);
          if (editandoId) formData.append("foto_atual", $("#imagemPreview").attr("src") || "");

          $.ajax({
            url: editandoId ? "editar.php" : "cadastro.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () { modal.hide(); location.reload(); },
            error: function () { alert("Erro ao salvar o contato."); }
          });
        }
      });
    });
  </script>
</body>

</html>