<?php
namespace service;

use dao\mysql\PlantaDAO;

class PlantaService extends PlantaDAO {
    
    public function listarPlantas() {
        return parent::listar();
    }

    public function buscarPlantaPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        return parent::listarPorId($id);
    }

    public function inserirPlanta($nome_cientifico, $nome_popular) {
        // Validações
        if (empty($nome_cientifico)) {
            throw new \Exception("Nome científico é obrigatório");
        }
        if (empty($nome_popular)) {
            throw new \Exception("Nome popular é obrigatório");
        }
        
        return parent::inserir($nome_cientifico, $nome_popular);
    }

    public function alterarPlanta($id, $nome_cientifico, $nome_popular) {
        // Validações
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        if (empty($nome_cientifico)) {
            throw new \Exception("Nome científico é obrigatório");
        }
        if (empty($nome_popular)) {
            throw new \Exception("Nome popular é obrigatório");
        }

        // Verifica se a planta existe
        $plantaExiste = parent::listarPorId($id);
        if (empty($plantaExiste)) {
            throw new \Exception("Planta não encontrada");
        }

        return parent::alterar($id, $nome_cientifico, $nome_popular);
    }

    public function deletarPlanta($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }

        // Verifica se a planta existe
        $plantaExiste = parent::listarPorId($id);
        if (empty($plantaExiste)) {
            throw new \Exception("Planta não encontrada");
        }

        return parent::deletar($id);
    }
}