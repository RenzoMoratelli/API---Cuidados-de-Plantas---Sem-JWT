<?php
namespace controller;

use service\CuidadoService;

class CuidadoController {
    private $service;

    public function __construct() {
        $this->service = new CuidadoService();
    }

    public function listar() {
        try {
            $dados = $this->service->listarCuidados();
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Cuidados listados com sucesso"
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
            $dados = $this->service->buscarCuidadoPorId($id);
            if (empty($dados)) {
                return [
                    "sucesso" => false,
                    "mensagem" => "Cuidado não encontrado"
                ];
            }
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Cuidado encontrado"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function buscarPorUsuario($usuario_id) {
        try {
            $dados = $this->service->buscarCuidadosPorUsuario($usuario_id);
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Cuidados do usuário listados com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function buscarPorPlanta($planta_id) {
        try {
            $dados = $this->service->buscarCuidadosPorPlanta($planta_id);
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Cuidados da planta listados com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function inserir($usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        try {
            $this->service->inserirCuidado($usuario_id, $planta_id, $tipo_cuidado, $frequencia);
            return [
                "sucesso" => true,
                "mensagem" => "Cuidado cadastrado com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function alterar($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia) {
        try {
            $this->service->alterarCuidado($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia);
            return [
                "sucesso" => true,
                "mensagem" => "Cuidado alterado com sucesso"
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
            $this->service->deletarCuidado($id);
            return [
                "sucesso" => true,
                "mensagem" => "Cuidado deletado com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }
}