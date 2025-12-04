<?php
namespace dao;

interface ICuidadoDAO {
    public function listar();
    public function listarPorId($id);
    public function listarPorUsuario($usuario_id);
    public function listarPorPlanta($planta_id);
    public function inserir($usuario_id, $planta_id, $tipo_cuidado, $frequencia);
    public function alterar($id, $usuario_id, $planta_id, $tipo_cuidado, $frequencia);
    public function deletar($id);
}