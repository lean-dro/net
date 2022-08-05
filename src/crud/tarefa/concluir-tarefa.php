<?php
include_once("../../models/Tarefa.php");

$tarefa = new Tarefa();

$tarefa->setIdTarefa($_GET['id']);
$tarefa->concluirTarefa($tarefa);
header("location: ../../../privado/tarefas.php?tab=home");