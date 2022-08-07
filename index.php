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
    

  <div class="d-flex justify-content-around ">


    <div class=" w-75 vh-100 p-5" style="background-color: #f8f9fa;">

      <h1 class="text-center display-6 mb-4 fw-semibold">Cadastro</h1>
      <form class="w-25 mx-auto" action="src/crud/usuario/insere-atualiza-usuario.php" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <input class="form-control" placeholder="Nome:" type="text" name="txtNome" />
          <label>Nome:</label>
        </div>

        <div class="form-floating mb-3">
          <input class="form-control" placeholder="Usuário:" type="text" name="txtUsuario" />
          <label>Usuário:</label>
        </div>

        <div class="form-floating mb-3">
          <input class="form-control" placeholder="Email" type="text" name="txtEmail" />
          <label>Email:</label>
        </div>

        <div class="form-floating mb-3">
          <input class="form-control" placeholder="Senha" type="password" name="txtSenha" />
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
        <button class="btn btn-success mb-3" type="submit">Cadastrar</button>
      </form>
    </div>

    <div class="w-25 p-5 vh-100" style="background-color: #212529;">
      <h1 class="text-center display-6 text-light mb-4 fw-semibold">Login</h1>
      <form action="src/verificaLogin.php" method="post">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="txtLogin" placeholder="name@example.com" />
          <label>Usuário:</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" placeholder="Senha:" name="txtSenha" />
          <label>Senha:</label>
        </div>

        <?php
        if (isset($_GET['erroLogin'])) {
          echo "credenciais invalidas <br>";
        }
        ?>
        <button class="btn btn-success" type="submit">Entrar</button>
      </form>
    </div>
  </div>



  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>