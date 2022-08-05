<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Não Exqueça Tudo</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/estilo.css" />
  </head>

  <body>
    <div class="row container mx-auto">
      <form
        class="col-6"
        action="src/crud/usuario/insere-atualiza-usuario.php"
        method="post"
        enctype="multipart/form-data"
      >
        <div class="form-floating mb-3">
          <input
            class="form-control"
            placeholder="Nome:"
            type="text"
            name="txtNome"
          />
          <label>Nome:</label>
        </div>

        <div class="form-floating mb-3">
          <input
            class="form-control"
            placeholder="Usuário:"
            type="text"
            name="txtUsuario"
          />
          <label>Usuário:</label>
        </div>

        <div class="form-floating mb-3">
          <input
            class="form-control"
            placeholder="Email"
            type="text"
            name="txtEmail"
          />
          <label>Email:</label>
        </div>

        <div class="form-floating mb-3">
          <input
            class="form-control"
            placeholder="Senha"
            type="password"
            name="txtSenha"
          />
          <label>Senha:</label>
        </div>

        <div class="mb-3">
          <label>Foto:</label>
          <input class="form-control" type="file" name="filePerfil" />
        </div>

        <?php
            if (isset($_GET['usuarioErro'])) {
                echo "usuario já existente";
            }
            ?>
        <button class="btn btn-primary" type="submit">Cadastrar</button>
      </form>

      <form
        class="col-6 float-start"
        action="src/verificaLogin.php"
        method="post"
      >
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            name="txtLogin"
            placeholder="name@example.com"
          />
          <label>Usuário:</label>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" placeholder="Senha:"  name="txtSenha" />
          <label>Senha:</label>
        </div>

        <?php
            if (isset($_GET['erroLogin'])) {
                echo "credenciais invalidas <br>";
                echo sha1("2e6f9b0d5885b6010f9167787445617f553a735f")."<br>";
                echo sha1("teste");
            }
            ?>
        <button class="btn btn-primary" type="submit">Entrar</button>
      </form>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
