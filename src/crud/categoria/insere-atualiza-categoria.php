<?php
include_once("../../models/Categoria.php");
include_once("../../models/Usuario.php");

$categoria = new Categoria();
$usuario = new Usuario();
$id = $_POST['txtIdCategoria'];
if ($id > 0) {
    $categoria->setNomeCategoria($_POST['txtCategoria']);
    $categoria->setIdCategoria($id);
    $categoria->update($categoria);
}else {
    $categoria->setNomeCategoria($_POST['txtCategoria']);
    $usuario->setIdUsuario($_POST['txtUsuario']);
    $categoria->setUsuario($usuario);
    $categoria->cadastrar($categoria);
}




header("location: ../../../privado/tarefas.php?tab=gerenciar");
