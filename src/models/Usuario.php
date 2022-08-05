<?php
require_once("Conexao.php");
class Usuario
{
    private $idUsuario;
    private $nomeUsuario;
    private $loginUsuario;
    private $emailUsuario;
    private $senhaUsuario;
    private $caminhoFotoUsuario;



    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }


    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }


    public function getLoginUsuario()
    {
        return $this->loginUsuario;
    }


    public function setLoginUsuario($loginUsuario)
    {
        $this->loginUsuario = $loginUsuario;
    }


    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }


    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;
    }


    public function getSenhaUsuario()
    {
        return $this->senhaUsuario;
    }


    public function setSenhaUsuario($senhaUsuario)
    {
        $this->senhaUsuario = $senhaUsuario;
    }


    public function getCaminhoFotoUsuario()
    {
        return $this->caminhoFotoUsuario;
    }


    public function setCaminhoFotoUsuario($caminhoFotoUsuario)
    {
        $this->caminhoFotoUsuario = $caminhoFotoUsuario;
    }

    public function cadastrar($usuario)
    {
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("INSERT INTO tbusuario VALUES (DEFAULT, ?, ?, ?, ?, ?) ");
        $stmt->bindValue(1, $usuario->getNomeUsuario());
        $stmt->bindValue(2, $usuario->getLoginUsuario());
        $stmt->bindValue(3, $usuario->getEmailUsuario());
        $stmt->bindValue(4, $usuario->getSenhaUsuario());
        $stmt->bindValue(5, $usuario->getCaminhoFotoUsuario());
        $stmt->execute();
    }

    public function listar()
    {
        $conexao = Conexao::conectar();
        $query = "SELECT idUsuario, nomeUsuario, loginUsuario, emailUsuario, senhaUsuario, caminhoFotoUsuario FROM tbusuario";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }

    public function verificaDisponibilidadeUsuario($usuarioCadastro)
    {
        $conexao = Conexao::conectar();
        $query = "SELECT loginUsuario FROM tbusuario";
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        $quantidadeUsuariosIguais = 0;
        foreach ($lista as $linha => $coluna) {
            $usuarioBanco = $lista[$linha]['loginUsuario'];
            if ($usuarioCadastro == $usuarioBanco) {
                $quantidadeUsuariosIguais =  $quantidadeUsuariosIguais + 1;
            }
        }
        if ($quantidadeUsuariosIguais > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function verificaLogin($login, $senha){
        $con = Conexao::conectar();
        $query = "SELECT loginUsuario, senhaUsuario FROM tbusuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        $auth = "";
        foreach ($lista as $linha => $coluna) {
            if (($lista[$linha]['loginUsuario'] == $login) && ($lista[$linha]['senhaUsuario'] == $senha)) {
               $auth = "aprovado";
            }
        }
        if ($auth == "aprovado") {
           return true;
           
        }else {
            return false;
        }

    }
    public function buscaId($login)
    {
        $con = Conexao::conectar();
        $query = "SELECT loginUsuario, idUsuario FROM tbusuario";
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();
        $idUsuario = "";
        foreach ($lista as $linha => $coluna) {
            if ($lista[$linha]['loginUsuario'] == $login) {
                $idUsuario = $lista[$linha]['idUsuario'];
            }
        }
        return $idUsuario;
    }
    public function infoUsuario($id){
        $con = Conexao::conectar();
        $query = "SELECT idUsuario, nomeUsuario, loginUsuario, emailUsuario, senhaUsuario, caminhoFotoUsuario FROM tbusuario WHERE idUsuario = ".$id;
        $resultado = $con->query($query);
        $lista = $resultado->fetchAll();

        return $lista;
    }

}
