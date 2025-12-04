<?php
namespace dao\mysql;

use dao\ICuidadoDAO;
use generic\MysqlFactory;

class CuidadoDAO extends MySqlFactory implements ICuidadoDAO {

    public function listar() {
        $sql = "SELECT c.id, c.usuario_id, u.nome as usuario_nome, c.planta_id, 
                p.nome_popular as planta_nome, c.tipo_cuidado, c.frequencia 
                FROM cuidados c
                INNER JOIN usuarios u ON c.usuario_id = u.id
                INNER JOIN plantas p ON c.planta_id = p.id
                ORDER BY c.id";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarPorId($id) {
        $sql = "SELECT c.id, c.usuario_id, u.nome as usuario_nome, c.planta_id, 
                p.nome_popular as planta_nome, c.tipo_cuidado, c.frequencia 
                FROM cuidados c
                INNER JOIN usuarios u ON c.usuario_id = u.id
                INNER JOIN plantas p ON c.planta_id = p.id
                WHERE c.id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT c.id, c.usuario_id, u.nome as usuario_nome, c.planta_id, 
                p.nome_popular as planta_nome, c.tipo_cuidado, c.frequencia 
                FROM cuidados c
                INNER JOIN usuarios u ON c.usuario_id = u.id
                INNER JOIN plantas p ON c.planta_id = p.id
                WHERE c.usuario_id = :usuario_id
                ORDER BY c.id";
        $param = [":usuario_id" => $usuario_id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function listarPorPlanta($planta_id) {
        $sql = "SELECT c.id, c.usuario_id, u.nome as usuario_nome, c.planta_id, 
                p.nome_popular as planta_nome, c.tipo_cuidado, c.frequencia 
                FROM cuidados c
                INNER JOIN usuarios u ON c.usuario_id = u.id
                INNER JOIN plantas p ON c.planta_id = p.id
                WHERE c.planta_id = :planta_id
                ORDER BY c.id";
        $param = [":planta_id" => $planta_id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        $sql = "INSERT INTO cuidados (usuario_id, planta_id, tipo_cuidado, frequencia) 
                VALUES (:usuario_id, :planta_id, :tipo_cuidado, :frequencia)";
        $param = [
            ":usuario_id" => $usuario_id,
            ":planta_id" => $planta_id,
            ":tipo_cuidado" => $tipo_cuidado,
            ":frequencia" => $frequencia
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function alterar($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        $sql = "UPDATE cuidados SET usuario_id = :usuario_id, planta_id = :planta_id, 
                tipo_cuidado = :tipo_cuidado, frequencia = :frequencia WHERE id = :id";
        $param = [
            ":id" => $id,
            ":usuario_id" => $usuario_id,
            ":planta_id" => $planta_id,
            ":tipo_cuidado" => $tipo_cuidado,
            ":frequencia" => $frequencia
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function deletar($id) {
        $sql = "DELETE FROM cuidados WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}