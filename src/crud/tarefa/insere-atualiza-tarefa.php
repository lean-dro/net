<?php
include_once("../../models/Tarefa.php");
include_once("../../models/Categoria.php");
include_once("../../models/Usuario.php");

$categoria = new Categoria();
$usuario = new Usuario();
$tarefa = new Tarefa();



$id = $_POST['txtIdTarefa'];
 if ($id > 0) {
    $tarefa->setIdTarefa($id);
    $usuario->setIdUsuario($_POST['txtIdUsuario']);
    $tarefa->setUsuario($usuario);
    $categoria->setIdCategoria($_POST['txtIdCategoria']);
    $tarefa->setCategoria($categoria);

    $tarefa->setDataLimite($_POST['dtLimite']);
    $tarefa->setDataOrigem($_POST['dtOrigem']);
    $tarefa->setTituloTarefa($_POST['txtTitulo']);
    $tarefa->setDescricaoTarefa($_POST['txtDescricao']);
    $tarefa->setStatus($_POST['status']);
    
    $tarefa->update($tarefa);
 }else {
    $usuario->setIdUsuario($_POST['txtIdUsuario']);
    $tarefa->setUsuario($usuario);
    $categoria->setIdCategoria($_POST['txtIdCategoria']);
    $tarefa->setCategoria($categoria);

    $tarefa->setDataLimite($_POST['dtLimite']);
    $tarefa->setDataOrigem($_POST['dtOrigem']);
    $tarefa->setTituloTarefa($_POST['txtTitulo']);
    $tarefa->setDescricaoTarefa($_POST['txtDescricao']);
    $tarefa->setStatus($_POST['status']);
    
    $tarefa->cadastrar($tarefa);
 }




header("location: ../../../privado/tarefas.php?tab=gerenciar");
