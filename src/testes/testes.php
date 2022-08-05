<?php

require_once("../models/Usuario.php");
require_once("../models/Categoria.php");
require_once("../models/Tarefa.php");
$usuario = new Usuario();
$tarefa = new Tarefa();

$disponibilidade = $usuario->verificaDisponibilidadeUsuario("leandro");

if ($disponibilidade == false) {
    echo "user indisponivel";
} else {
    echo "user disponivel";
}

$loginStatus = $usuario->verificaLogin("leandrinho", "123");
if ($loginStatus == true) {
    echo "entre";
}

$categoria = new Categoria();
$lista = $categoria->listarPrivado(1);
foreach ($lista as $linha) {
   echo $linha[3]."<br>";
}

session_start();
echo json_encode($_SESSION);
echo "<br>";
try {
    $lista = $tarefa->listarPrivado(1);
  foreach ($lista as $linha) {
        echo $linha[0]."<br>";
        echo $linha[1] . "<br>";
        echo $linha[2] . "<br>";
        echo $linha[3] . "<br>";
        echo $linha[4] . "<br>";
        echo $linha[5] . "<br>";
        echo $linha[6] . "<br>";
        echo $linha[7] . "<br>";
        echo $linha[8] . "<br>";
        echo $linha[9] . "<br>";
  }

} catch (Exception $th) {
    echo $th ;
}

