<?php
include_once("../../models/Categoria.php");

$id = $_GET['id'];
$categoria = new Categoria();
$categoria->setIdCategoria($id);
$categoria->delete($categoria);

header("location: ../../../privado/tarefas?tab=gerenciar.php");