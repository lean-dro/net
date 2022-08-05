<?php
require_once("models/Usuario.php");
$usuario = new Usuario();

$lista = $usuario->listar();

$senha = sha1($_POST['txtSenha']);
$login = $_POST['txtLogin'];

$status = $usuario->verificaLogin($login, $senha);
if ($status == true) {
    session_start();
    $id = $usuario->buscaId($login);
    $lista = $usuario->infoUsuario($id);
    foreach ($lista as $linha) {
        $_SESSION['id'] = $linha['idUsuario'];
        $_SESSION['nome'] = $linha['nomeUsuario'];
        $_SESSION['login'] = $linha['loginUsuario'];
        $_SESSION['email'] = $linha['emailUsuario'];
        $_SESSION['senha'] = $linha['senhaUsuario'];
        $_SESSION['fotoUsuario'] = $linha['caminhoFotoUsuario'];
    }
    header("location: ../privado/tarefas.php?tab=home");
} else {
    header("location: ../index.php?erroLogin");
}

