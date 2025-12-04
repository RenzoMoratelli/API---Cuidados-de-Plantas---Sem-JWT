<?php
namespace controller;

use service\PlantaService;

class PlantaController {
    private $service;

    public function __construct() {
        $this->service = new PlantaService();
    }

    public function listar() {
        try {
            $dados = $this->service->listarPlantas();
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Plantas listadas com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function buscarPorId($id) {
        try {
            $dados = $this->service->buscarPlantaPorId($id);
            if (empty($dados)) {
                return [
                    "sucesso" => false,
                    "mensagem" => "Planta não encontrada"
                ];
            }
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Planta encontrada"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function inserir($nome_cientifico, $nome_popular) {
        try {
            $this->service->inserirPlanta($nome_cientifico, $nome_popular);
            return [
                "sucesso" => true,
                "mensagem" => "Planta cadastrada com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function alterar($id, $nome_cientifico, $nome_popular) {
        try {
            $this->service->alterarPlanta($id, $nome_cientifico, $nome_popular);
            return [
                "sucesso" => true,
                "mensagem" => "Planta alterada com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function deletar($id) {
        try {
            $this->service->deletarPlanta($id);
            return [
                "sucesso" => true,
                "mensagem" => "Planta deletada com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }
}