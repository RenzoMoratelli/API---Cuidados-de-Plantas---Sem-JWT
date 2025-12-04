<?php
namespace dao\mysql;

use dao\IPlantaDAO;
use generic\MysqlFactory;

class PlantaDAO extends MySqlFactory implements IPlantaDAO {

    public function listar() {
        $sql = "SELECT id, nome_cientifico, nome_popular FROM plantas ORDER BY nome_popular";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarPorId($id) {
        $sql = "SELECT id, nome_cientifico, nome_popular FROM plantas WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($nome_cientifico, $nome_popular) {
        $sql = "INSERT INTO plantas (nome_cientifico, nome_popular) VALUES (:nome_cientifico, :nome_popular)";
        $param = [
            ":nome_cientifico" => $nome_cientifico,
            ":nome_popular" => $nome_popular
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function alterar($id, $nome_cientifico, $nome_popular) {
        $sql = "UPDATE plantas SET nome_cientifico = :nome_cientifico, nome_popular = :nome_popular WHERE id = :id";
        $param = [
            ":id" => $id,
            ":nome_cientifico" => $nome_cientifico,
            ":nome_popular" => $nome_popular
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function deletar($id) {
        $sql = "DELETE FROM plantas WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}