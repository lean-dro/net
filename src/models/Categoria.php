<?php
require_once("Conexao.php");
class Categoria
{
    private $idCategoria;
    private $usuario;
    private $nomeCategoria;

    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }


    public function getUsuario()
    {
        return $this->usuario;
    }


    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


    public function getNomeCategoria()
    {
        return $this->nomeCategoria;
    }


    public function setNomeCategoria($nomeCategoria)
    {
        $this->nomeCategoria = $nomeCategoria;
    }

    public function cadastrar($categoria){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("INSERT INTO tbcategoria VALUES (DEFAULT, ?, ?)");
        $stmt->bindValue(1, $categoria->getUsuario()->getIdUsuario());
        $stmt->bindValue(2, $categoria->getNomeCategoria());
        $stmt->execute();
    }
    public function update($categoria){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("UPDATE tbcategoria set nomeCategoria = ? WHERE idCategoria = ?");
        $stmt->bindValue(1, $categoria->getNomeCategoria());
        $stmt->bindValue(2, $categoria->getIdCategoria());
        $stmt->execute();
    }
    public function delete($categoria){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("SET FOREIGN_KEY_CHECKS=0; DELETE FROM tbcategoria WHERE idCategoria = ?; SET FOREIGN_KEY_CHECKS=1;");
        $stmt->bindValue(1, $categoria->getIdCategoria());
        $stmt->execute();
    }
    public function listar(){
        $conexao = Conexao::conectar();
        $query = "SELECT idCategoria, idUsuario, nomeCategoria, nomeUsuario FROM tbcategoria
                    INNER JOIN tbusuario on tbusuario.idUsuario = tbcategoria.idUsuario";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    public function listarPrivado($id){
        $conexao = Conexao::conectar();
        $query = "SELECT idCategoria, tbcategoria.idUsuario, nomeCategoria, nomeUsuario FROM tbcategoria
                    INNER JOIN tbusuario on tbusuario.idUsuario = tbcategoria.idUsuario
                    WHERE tbcategoria.idUsuario = $id";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
}
