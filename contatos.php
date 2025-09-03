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
    echo "<div class='container-contatos'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class='cartao-contato'>";

      echo "<div class='cabecalho-cartao'><h3>" . htmlspecialchars($row['nome']) . "</h3></div>";

      echo "<div class='corpo-cartao'>";
      $foto = !empty($row['foto']) ? htmlspecialchars($row['foto']) : 'https://cdn-icons-png.freepik.com/512/64/64572.png';
      echo "<img src='{$foto}' alt='Foto de " . htmlspecialchars($row['nome']) . "' class='imagem-contato'>";

      echo "<div class='informacoes-contato'>";
      echo "<p><i class='fas fa-user'></i><strong> Login:</strong> " . htmlspecialchars($row['login']) . "</p>";
      echo "<p><i class='fas fa-lock'></i><strong> Senha:</strong> " . htmlspecialchars($row['senha']) . "</p>";
      echo "<p><i class='fas fa-envelope'></i><strong> Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
      echo "<p><i class='fas fa-phone'></i><strong> Telefone:</strong> " . htmlspecialchars($row['telefone']) . "</p>";
      echo "</div>";
      echo "</div>";

      echo "<div class='rodape-cartao'>";
      echo "<button class='botao-editar'
              data-id='" . htmlspecialchars($row['id']) . "'
              data-nome='" . htmlspecialchars($row['nome']) . "'
              data-login='" . htmlspecialchars($row['login']) . "'
              data-email='" . htmlspecialchars($row['email']) . "'
              data-telefone='" . htmlspecialchars($row['telefone']) . "'
              data-senha='" . htmlspecialchars($row['senha']) . "'
              data-foto='" . htmlspecialchars($row['foto']) . "'>
              <i class='fas fa-edit'></i> Editar</button>";

      // >>> IMPORTANTE: incluir data-id no botão excluir
      echo "<button class='botao-excluir' data-id='" . htmlspecialchars($row['id']) . "'><i class='fas fa-trash'></i> Excluir</button>";
      echo "</div>";

      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<p class='sem-contato'>Nenhum contato encontrado.</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Contatos</title>
  <link rel="stylesheet" href="contato.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
  <main>
    <aside class="container__barra-lateral">
      <div class="cabecalho-barra-lateral">
        <div class="avatar-usuario">
          <img
            src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'https://via.placeholder.com/150'; ?>"
            alt="Foto do usuário">
        </div>
        <div>
          <h2><?php echo htmlspecialchars($usuario['nome']); ?></h2>
          <p class="subtitulo">Lumiere</p>
        </div>
      </div>

      <nav class="menu-barra-lateral">
        <a href="home.php" class="item-menu">
          <i class="fas fa-home"></i>
          <span>Início</span>
        </a>
        <a href="#" class="item-menu ativo">
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
        <h1>Contatos</h1>
        <button class="botao-adicionar">Adicionar Contato</button>
      </div>

      <p class="texto-boas-vindas">Gerencie os contatos</p>

      <?php listarContatos(); ?>
    </section>
  </main>

  <div id="modal" class="modal" style="display: none;">
    <div class="modal-conteudo">

      <div class="modal-cabecalho">
        <h2 class="modal-titulo">Adicionar Contato</h2>
        <!-- manter o onclick, mas a função estará GLOBAL -->
        <button class="btn-fechar" onclick="fecharModal()">&times;</button>
      </div>

      <div class="modal-corpo">

        <form id="formContato" class="form" enctype="multipart/form-data">
          <div class="foto">
            <label for="imagemInput" class="fotoLabel">
              <div id="imagemPreview" class="foto-icon">
                <i class="fas fa-plus"></i>
              </div>
            </label>
           <input type="file" id="imagemInput" name="campo6" accept="image/*" style="display: none;">
            <p class="foto-texto">Clique para adicionar uma foto</p>
          </div>

          <div class="caixaInputs">
            <div class="linha">
              <label>Nome
                <div class="input-container">
                  <i class="fas fa-user"></i>
                  <input type="text" placeholder="Digite seu nome" id="nome" required>
                </div>
                <span class="erro" id="erroNome"></span>
              </label>

              <label>Login
                <div class="input-container">
                  <i class="fas fa-id-badge"></i>
                  <input type="text" placeholder="Digite seu login" id="login" required>
                </div>
                <span class="erro" id="erroLogin"></span>
              </label>
            </div>

            <div class="linha">
              <label>E-mail
                <div class="input-container">
                  <i class="fas fa-envelope"></i>
                  <input type="email" placeholder="Digite seu e-mail" id="email" required>
                </div>
                <span class="erro" id="erroEmail"></span>
              </label>

              <label>Telefone
                <div class="input-container">
                  <i class="fas fa-phone"></i>
                  <input type="tel" placeholder="(00) 00000-0000" id="telefone" required>
                </div>
                <span class="erro" id="erroTelefone"></span>
              </label>
            </div>

            <div class="linha">
              <label>Senha
                <div class="senha-container input-container">
                  <i class="fas fa-lock"></i>
                  <input type="password" placeholder="Digite sua senha" id="senha" required>
                  <span class="mostrarSenha"><i class="fas fa-eye"></i></span>
                </div>
                <span class="erro" id="erroSenha"></span>
                <div class="forca-senha">
                  <div id="barraForcaSenha" class="barra"></div>
                </div>
              </label>

              <label>Confirmar senha
                <div class="senha-container input-container">
                  <i class="fas fa-lock"></i>
                  <input type="password" placeholder="Confirme sua senha" id="confirmarSenha" required>
                  <span class="mostrarSenha"><i class="fas fa-eye"></i></span>
                </div>
                <span class="erro" id="erroConfirmarSenha"></span>
                <div class="forca-senha">
                  <div id="barraForcaConfirmar" class="barra"></div>
                </div>
              </label>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-rodape">
        <button class="botao-primario" id="botaoSalvar">
          <i class="fas fa-save"></i> Salvar
        </button>
        <button class="botao-excluir" id="botaoCancelar">
          <i class="fas fa-times"></i> Cancelar
        </button>
      </div>

    </div>
  </div>

  <script>
    function abrirModal() {
      $('#modal').css('display', 'flex');
    }
    function fecharModal() {
      $('#modal').css('display', 'none');
    }

    $(document).ready(function () {
      $('.item-menu').on('click', function () {
        $('.item-menu').removeClass('ativo');
        $(this).addClass('ativo');
      });

      let editandoId = null;

      $('.botao-adicionar').on('click', function (e) {
        e.preventDefault();
        $('.modal-titulo').text("Adicionar Contato");
        $('#formContato')[0].reset();
        $('#imagemPreview').html('<i class="fas fa-plus"></i>');
        $('#imagemPreview').removeClass('with-image');
        $('.foto-texto').text('Clique para adicionar uma foto');
        editandoId = null;
        abrirModal();
      });

      $('.btn-fechar, #botaoCancelar').on('click', fecharModal);

      $(document).on('click', '.botao-editar', function () {
        $('.modal-titulo').text("Editar Contato");

        editandoId = $(this).data('id');

        $('#nome').val($(this).data('nome'));
        $('#login').val($(this).data('login'));
        $('#email').val($(this).data('email'));
        $('#telefone').val($(this).data('telefone'));
        $('#senha').val($(this).data('senha'));
        $('#confirmarSenha').val($(this).data('senha'));

        const foto = $(this).data('foto');
        if (foto) {
          $('#imagemPreview').html('<img src="' + foto + '" alt="Preview da foto">');
          $('#imagemPreview').addClass('with-image');
          $('.foto-texto').text('Foto carregada');
        } else {
          $('#imagemPreview').html('<i class="fas fa-plus"></i>').removeClass('with-image');
          $('.foto-texto').text('Clique para adicionar uma foto');
        }

        abrirModal();
      });


      $(document).on('click', '.botao-excluir', function () {
        const id = $(this).data('id');
        if (!id) {
          alert("ID do contato não encontrado.");
          return;
        }
        if (confirm("Deseja realmente excluir este contato?")) {
          $.ajax({
            url: "excluir.php",
            type: "POST",
            data: { campo0: id },
            dataType: "html"
          }).done(function (resp) {
            location.reload();
          }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Request failed: " + textStatus + " - " + errorThrown);
            alert("Erro ao excluir contato. Tente novamente.");
          });
        }
      });

      $("#imagemInput").change(function () {
        if (this.files && this.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#imagemPreview').html('<img src="' + e.target.result + '" alt="Preview da foto">');
            $('#imagemPreview').addClass('with-image');
            $('.foto-texto').text('Foto adicionada com sucesso!');
          }
          reader.readAsDataURL(this.files[0]);
        }
      });

      // Mostrar/ocultar senha
      $(".mostrarSenha").click(function () {
        const input = $(this).siblings("input");
        const icon = $(this).find("i");
        if (input.attr("type") === "password") {
          input.attr("type", "text");
          icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
          input.attr("type", "password");
          icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
      });

      // Força da senha
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
        barra.css("width", forca + "%");
        if (forca < 40) barra.css("background-color", "red");
        else if (forca < 80) barra.css("background-color", "orange");
        else barra.css("background-color", "green");
      }

      $("#senha").on("input", function () {
        const senha = $(this).val();
        atualizarBarra($("#barraForcaSenha"), calcularForca(senha));
      });

      $("#confirmarSenha").on("input", function () {
        const senha = $(this).val();
        atualizarBarra($("#barraForcaConfirmar"), calcularForca(senha));
      });

      // Máscara de telefone simples
      $("#telefone").on("input", function () {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 2) {
          value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
        }
        if (value.length > 10) {
          value = `${value.substring(0, 10)}-${value.substring(10, 14)}`;
        }
        $(this).val(value);
      });

      function validarFormulario() {
        let valido = true;
        $(".erro").text("");

        const nome = $("#nome").val().trim();
        if (nome === "") {
          $("#erroNome").text("Por favor, insira seu nome.");
          valido = false;
        }

        const login = $("#login").val().trim();
        if (login === "") {
          $("#erroLogin").text("Por favor, insira seu login.");
          valido = false;
        }

        const email = $("#email").val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          $("#erroEmail").text("E-mail inválido.");
          valido = false;
        }

        const telefone = $("#telefone").val().replace(/\D/g, '');
        if (telefone.length < 10) {
          $("#erroTelefone").text("Telefone inválido.");
          valido = false;
        }

        const senha = $("#senha").val();
        const confirmarSenha = $("#confirmarSenha").val();
        if (senha !== confirmarSenha || senha.length === 0) {
          $("#erroConfirmarSenha").text("As senhas não coincidem ou estão vazias.");
          $("#erroSenha").text("As senhas não coincidem ou estão vazias.");
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

          // pega a imagem escolhida
          if ($("#imagemInput")[0].files.length > 0) {
            formData.append("campo6", $("#imagemInput")[0].files[0]);
          }

          // se estiver editando, manda a foto atual
          if (editandoId) {
            formData.append("foto_atual", $("#imagemPreview img").attr("src") || "");
          }

          let url = editandoId ? "editar.php" : "cadastro.php";

          $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
              console.log(response);
              fecharModal();
              location.reload();
            },
            error: function (xhr, status, error) {
              console.error("Erro: " + error);
              alert("Erro ao salvar o contato.");
            }
          });
        }
      });

    });
  </script>
</body>

</html>