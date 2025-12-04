<?php
namespace service;

use dao\mysql\UsuarioDAO;

class UsuarioService extends UsuarioDAO {
    
    public function listarUsuarios() {
        return parent::listar();
    }

    public function buscarUsuarioPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        return parent::listarPorId($id);
    }

    public function inserirUsuario($nome, $email) {
        // Validações
        if (empty($nome)) {
            throw new \Exception("Nome é obrigatório");
        }
        if (empty($email)) {
            throw new \Exception("Email é obrigatório");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Email inválido");
        }
        
        return parent::inserir($nome, $email);
    }

    public function alterarUsuario($id, $nome, $email) {
        // Validações
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }
        if (empty($nome)) {
            throw new \Exception("Nome é obrigatório");
        }
        if (empty($email)) {
            throw new \Exception("Email é obrigatório");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Email inválido");
        }

        // Verifica se o usuário existe
        $usuarioExiste = parent::listarPorId($id);
        if (empty($usuarioExiste)) {
            throw new \Exception("Usuário não encontrado");
        }

        return parent::alterar($id, $nome, $email);
    }

    public function deletarUsuario($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new \Exception("ID inválido");
        }

        // Verifica se o usuário existe
        $usuarioExiste = parent::listarPorId($id);
        if (empty($usuarioExiste)) {
            throw new \Exception("Usuário não encontrado");
        }

        return parent::deletar($id);
    }
}