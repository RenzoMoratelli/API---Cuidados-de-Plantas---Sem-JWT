<?php 

namespace generic;

class Controller
{
    private $rotas = null;

    public function __construct()
    {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota)
    {
        $retorno = $this->rotas->executar($rota);

        if ($retorno) {
            header("Content-Type: application/json");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type");
            
            $json = json_encode($retorno);
            echo $json;
        } else {
            header("HTTP/1.1 404 Not Found");
            header("Content-Type: application/json");
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Endpoint não encontrado"
            ]);
        }
    }
}