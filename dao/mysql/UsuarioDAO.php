<?php
namespace dao\mysql;

use dao\IUsuarioDAO;
use generic\MysqlFactory;

class UsuarioDAO extends MySqlFactory implements IUsuarioDAO {

    public function listar() {
        $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarPorId($id) {
        $sql = "SELECT id, nome, email FROM usuarios WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($nome, $email) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $param = [
            ":nome" => $nome,
            ":email" => $email
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function alterar($id, $nome, $email) {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $param = [
            ":id" => $id,
            ":nome" => $nome,
            ":email" => $email
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function deletar($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}