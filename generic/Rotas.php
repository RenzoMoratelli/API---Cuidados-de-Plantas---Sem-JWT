<?php 

namespace generic;

class Rotas
{
    private $endpoints = [];

    public function __construct()
    {
        $this->endpoints = [
            // Rotas de Plantas
            "plantas" => new Acao([
                Acao::GET => new Endpoint("PlantaController", "listar"),
                Acao::POST => new Endpoint("PlantaController", "inserir")
            ]),
            "plantas/buscar" => new Acao([
                Acao::GET => new Endpoint("PlantaController", "buscarPorId")
            ]),
            "plantas/alterar" => new Acao([
                Acao::PUT => new Endpoint("PlantaController", "alterar")
            ]),
            "plantas/deletar" => new Acao([
                Acao::DELETE => new Endpoint("PlantaController", "deletar")
            ]),

            // Rotas de Usuários
            "usuarios" => new Acao([
                Acao::GET => new Endpoint("UsuarioController", "listar"),
                Acao::POST => new Endpoint("UsuarioController", "inserir")
            ]),
            "usuarios/buscar" => new Acao([
                Acao::GET => new Endpoint("UsuarioController", "buscarPorId")
            ]),
            "usuarios/alterar" => new Acao([
                Acao::PUT => new Endpoint("UsuarioController", "alterar")
            ]),
            "usuarios/deletar" => new Acao([
                Acao::DELETE => new Endpoint("UsuarioController", "deletar")
            ]),

            // Rotas de Cuidados
            "cuidados" => new Acao([
                Acao::GET => new Endpoint("CuidadoController", "listar"),
                Acao::POST => new Endpoint("CuidadoController", "inserir")
            ]),
            "cuidados/buscar" => new Acao([
                Acao::GET => new Endpoint("CuidadoController", "buscarPorId")
            ]),
            "cuidados/usuario" => new Acao([
                Acao::GET => new Endpoint("CuidadoController", "buscarPorUsuario")
            ]),
            "cuidados/planta" => new Acao([
                Acao::GET => new Endpoint("CuidadoController", "buscarPorPlanta")
            ]),
            "cuidados/alterar" => new Acao([
                Acao::PUT => new Endpoint("CuidadoController", "alterar")
            ]),
            "cuidados/deletar" => new Acao([
                Acao::DELETE => new Endpoint("CuidadoController", "deletar")
            ])
        ];
    }

    public function executar($rota)
    {
        if (isset($this->endpoints[$rota])) {
            $endpoint = $this->endpoints[$rota];
            $dados = $endpoint->executar();
            $retorno = new Retorno();
            $retorno->dados = $dados;
            return $retorno;
        }
        
        return null;
    }
}