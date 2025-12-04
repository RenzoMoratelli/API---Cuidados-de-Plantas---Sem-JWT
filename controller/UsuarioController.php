<?php
namespace controller;

use service\UsuarioService;

class UsuarioController {
    private $service;

    public function __construct() {
        $this->service = new UsuarioService();
    }

    public function listar() {
        try {
            $dados = $this->service->listarUsuarios();
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Usuários listados com sucesso"
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
            $dados = $this->service->buscarUsuarioPorId($id);
            if (empty($dados)) {
                return [
                    "sucesso" => false,
                    "mensagem" => "Usuário não encontrado"
                ];
            }
            return [
                "sucesso" => true,
                "dados" => $dados,
                "mensagem" => "Usuário encontrado"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function inserir($nome, $email) {
        try {
            $this->service->inserirUsuario($nome, $email);
            return [
                "sucesso" => true,
                "mensagem" => "Usuário cadastrado com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }

    public function alterar($id, $nome, $email) {
        try {
            $this->service->alterarUsuario($id, $nome, $email);
            return [
                "sucesso" => true,
                "mensagem" => "Usuário alterado com sucesso"
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
            $this->service->deletarUsuario($id);
            return [
                "sucesso" => true,
                "mensagem" => "Usuário deletado com sucesso"
            ];
        } catch (\Exception $e) {
            return [
                "sucesso" => false,
                "mensagem" => $e->getMessage()
            ];
        }
    }
}