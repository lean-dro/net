<?php
include_once("../../models/Tarefa.php");

$id = $_GET['id'];
$tarefa = new Tarefa();
$tarefa->setIdtarefa($id);
$tarefa->delete($tarefa);

header("location: ../../../privado/tarefas.php?tab=gerenciar");