<?php 
require_once("../../models/Usuario.php");
$usuario = new Usuario();

$usuarioForm = $_POST['txtUsuario'];
$disponibilidade = $usuario->verificaDisponibilidadeUsuario($usuarioForm);

if ($disponibilidade == true) {
    $usuario->setNomeUsuario($_POST['txtNome']);
    $usuario->setEmailUsuario($_POST['txtEmail']);
    $usuario->setLoginUsuario($usuarioForm);
    $usuario->setSenhaUsuario(sha1($_POST['txtSenha']));
    $nomeArquivo = $_FILES['filePerfil']['name'];
    $arquivo = $_FILES['filePerfil']['tmp_name'];
    move_uploaded_file($arquivo, "../../images/fotosUsuarios/" . $nomeArquivo);
    $endereco = "images/fotosUsuarios/" . $nomeArquivo;
    $usuario->setCaminhoFotoUsuario($endereco);
    $usuario->cadastrar($usuario);
    header("location: ../../../index.php?usuarioCadastro");
}else {
    header("location: ../../../index.php?usuarioErro");
}


