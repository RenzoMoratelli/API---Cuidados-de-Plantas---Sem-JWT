<?php
namespace dao;

interface IUsuarioDAO {
    public function listar();
    public function listarPorId($id);
    public function inserir($nome, $email);
    public function alterar($id, $nome, $email);
    public function deletar($id);
}