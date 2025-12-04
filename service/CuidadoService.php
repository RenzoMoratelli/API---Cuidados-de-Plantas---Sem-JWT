<?php
namespace service;

use dao\mysql\CuidadoDAO;
use dao\mysql\UsuarioDAO;
use dao\mysql\PlantaDAO;

class CuidadoService extends CuidadoDAO {
    
    public function listarCuidados() {
        return parent::listar();
    }

    public function buscarCuidadoPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        return parent::listarPorId($id);
    }

    public function buscarCuidadosPorUsuario($usuario_id) {
        if (empty($usuario_id) || !is_numeric($usuario_id)) {
            throw new \Exception("ID de usuário inválido");
        }
        return parent::listarPorUsuario($usuario_id);
    }

    public function buscarCuidadosPorPlanta($planta_id) {
        if (empty($planta_id) || !is_numeric($planta_id)) {
            throw new \Exception("ID de planta inválido");
        }
        return parent::listarPorPlanta($planta_id);
    }

    public function inserirCuidado($usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        // Validações
        if (empty($usuario_id) || !is_numeric($usuario_id)) {
            throw new \Exception("ID de usuário inválido");
        }
        if (empty($planta_id) || !is_numeric($planta_id)) {
            throw new \Exception("ID de planta inválido");
        }
        if (empty($tipo_cuidado)) {
            throw new \Exception("Tipo de cuidado é obrigatório");
        }
        if (empty($frequencia) || !is_numeric($frequencia) || $frequencia <= 0) {
            throw new \Exception("Frequência deve ser um número positivo");
        }

        // Verifica se o usuário existe
        $usuarioDAO = new UsuarioDAO();
        $usuarioExiste = $usuarioDAO->listarPorId($usuario_id);
        if (empty($usuarioExiste)) {
            throw new \Exception("Usuário não encontrado");
        }

        // Verifica se a planta existe
        $plantaDAO = new PlantaDAO();
        $plantaExiste = $plantaDAO->listarPorId($planta_id);
        if (empty($plantaExiste)) {
            throw new \Exception("Planta não encontrada");
        }

        return parent::inserir($usuario_id, $planta_id, $tipo_cuidado, $frequencia);
    }

    public function alterarCuidado($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        // Validações
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        if (empty($usuario_id) || !is_numeric($usuario_id)) {
            throw new \Exception("ID de usuário inválido");
        }
        if (empty($planta_id) || !is_numeric($planta_id)) {
            throw new \Exception("ID de planta inválido");
        }
        if (empty($tipo_cuidado)) {
            throw new \Exception("Tipo de cuidado é obrigatório");
        }
        if (empty($frequencia) || !is_numeric($frequencia) || $frequencia <= 0) {
            throw new \Exception("Frequência deve ser um número positivo");
        }

        // Verifica se o cuidado existe
        $cuidadoExiste = parent::listarPorId($id);
        if (empty($cuidadoExiste)) {
            throw new \Exception("Cuidado não encontrado");
        }

        // Verifica se o usuário existe
        $usuarioDAO = new UsuarioDAO();
        $usuarioExiste = $usuarioDAO->listarPorId($usuario_id);
        if (empty($usuarioExiste)) {
            throw new \Exception("Usuário não encontrado");
        }

        // Verifica se a planta existe
        $plantaDAO = new PlantaDAO();
        $plantaExiste = $plantaDAO->listarPorId($planta_id);
        if (empty($plantaExiste)) {
            throw new \Exception("Planta não encontrada");
        }

        return parent::alterar($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia);
    }

    public function deletarCuidado($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }

        // Verifica se o cuidado existe
        $cuidadoExiste = parent::listarPorId($id);
        if (empty($cuidadoExiste)) {
            throw new \Exception("Cuidado não encontrado");
        }

        return parent::deletar($id);
    }
}