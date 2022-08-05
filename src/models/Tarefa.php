<?php
require_once("Conexao.php");
class Tarefa
{
    private $idTarefa;
    private $usuario;
    private $categoria;
    private $dataOrigem;
    private $dataLimite;
    private $tituloTarefa;
    private $descricaoTarefa;
    private $status;


    public function getIdTarefa(){
        return $this->idTarefa;
    }


    public function setIdTarefa($idTarefa){
        $this->idTarefa = $idTarefa;
    }


    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }


    public function getCategoria(){
        return $this->categoria;
    }


    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }


    public function getDataOrigem(){
        return $this->dataOrigem;
    }


    public function setDataOrigem($dataOrigem){
        $this->dataOrigem = $dataOrigem;
    }


    public function getDataLimite(){
        return $this->dataLimite;
    }


    public function setDataLimite($dataLimite){
        $this->dataLimite = $dataLimite;
    }


    public function getTituloTarefa(){
        return $this->tituloTarefa;
    }


    public function setTituloTarefa($tituloTarefa){
        $this->tituloTarefa = $tituloTarefa;
    }


    public function getDescricaoTarefa(){
        return $this->descricaoTarefa;
    }


    public function setDescricaoTarefa($descricaoTarefa){
        $this->descricaoTarefa = $descricaoTarefa;
    }


    public function getStatus(){
        return $this->status;
    }


    public function setStatus($status){
        $this->status = $status;
    }

    public function cadastrar($tarefa){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("INSERT INTO tbtarefa VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1 ,$tarefa->getUsuario()->getIdUsuario());
        $stmt->bindValue(2 ,$tarefa->getDataOrigem());
        $stmt->bindValue(3 ,$tarefa->getDataLimite());
        $stmt->bindValue(4 ,$tarefa->getTituloTarefa());
        $stmt->bindValue(5 ,$tarefa->getDescricaoTarefa());
        $stmt->bindValue(6, $tarefa->getStatus());
        $stmt->bindValue(7, $tarefa->getCategoria()->getIdCategoria());
        $stmt->execute();
    }
    public function listar(){
        $conexao = Conexao::conectar();
        $query = "SELECT idTarefa, idUsuario, dataOrigem, dataLimite, tituloTarefa, descricaoTarefa, statusTarefa, tbtarefa.idCategoria, nomeCategoria 
        INNER JOIN tbcategoria on tbcategoria.idCategoria = tbtarefa.idCategoria
        ORDER BY dataLimite
        FROM tbtarefa";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    public function listarQtdConcluido($id){
        $conexao = Conexao::conectar();
        $query = "SELECT COUNT(idTarefa) FROM tbtarefa WHERE statusLogin = 1 AND idUsuario =".$id;
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchColumn('count');
        return $lista;
    }
    public function listarQtdPendente($id)
    {
        $conexao = Conexao::conectar();
        $query = "SELECT COUNT(idTarefa) as 'count' FROM tbtarefa WHERE statusLogin = 0 AND idUsuario =".$id;
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchColumn('count');
        return $lista;
    }
    public function listarPrivado($id){
        $conexao = Conexao::conectar();
        $query = "SELECT idTarefa, tbtarefa.idUsuario as idUsuario, dataLimite as dt,
                    DATE_FORMAT(dataOrigem, '%d/%m') as dataOrigem, 
                    DATE_FORMAT(dataLimite, '%d/%m') as dataLimite, tituloTarefa, descricaoTarefa, statusTarefa, 
                    tbtarefa.idCategoria as idCategoria, nomeCategoria,
                    DATEDIFF(dataLimite, CURRENT_DATE()) as 'diasRestantes' 
        FROM tbtarefa
        LEFT JOIN tbcategoria on tbcategoria.idCategoria = tbtarefa.idCategoria
        WHERE tbtarefa.idUsuario = ".$id."
        GROUP BY nomeCategoria
        ORDER BY dataLimite";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }

    public function listarPrivadoPend($id)
    {
        $conexao = Conexao::conectar();
        $query = "SELECT idTarefa, tbtarefa.idUsuario as idUsuario, dataLimite as dt,
                    DATE_FORMAT(dataOrigem, '%d/%m') as dataOrigem, 
                    DATE_FORMAT(dataLimite, '%d/%m') as dataLimite, tituloTarefa, descricaoTarefa, statusTarefa, 
                    tbtarefa.idCategoria as idCategoria, nomeCategoria,
                    DATEDIFF(dataLimite, CURRENT_DATE()) as 'diasRestantes' 
        FROM tbtarefa
        LEFT JOIN tbcategoria on tbcategoria.idCategoria = tbtarefa.idCategoria
        WHERE statusTarefa = 0 AND tbtarefa.idUsuario = " . $id . "
        GROUP BY nomeCategoria
        ORDER BY dataLimite";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    
    public function update($tarefa){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("UPDATE tbtarefa 
        set idUsuario = ? ,dataOrigem = ?, dataLimite = ?, tituloTarefa = ?, descricaoTarefa = ?, statusTarefa = ?, idCategoria = ?
        where idTarefa = ?");
        $stmt->bindValue(1, $tarefa->getUsuario()->getIdUsuario());
        $stmt->bindValue(2, $tarefa->getDataOrigem());
        $stmt->bindValue(3, $tarefa->getDataLimite());
        $stmt->bindValue(4, $tarefa->getTituloTarefa());
        $stmt->bindValue(5, $tarefa->getDescricaoTarefa());
        $stmt->bindValue(6, $tarefa->getStatus());
        $stmt->bindValue(7, $tarefa->getCategoria()->getIdCategoria());
        $stmt->bindValue(8, $tarefa->getIdTarefa());
        $stmt->execute();
    }
    public function delete($tarefa){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("DELETE FROM tbtarefa WHERE idTarefa = ?");
        $stmt->bindValue(1, $tarefa->getIdTarefa());
        $stmt->execute();
    }
    public function concluirTarefa($tarefa){
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("UPDATE tbtarefa set statusTarefa = 1 WHERE idTarefa = ?");
        $stmt->bindValue(1, $tarefa->getIdTarefa());
        $stmt->execute();
    }
    public function modalTarefa($id){
        $conexao = Conexao::conectar();
        $query = "SELECT tituloTarefa, descricaoTarefa FROM tbtarefa WHERE idTarefa = ".$id;
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
}
