<?php 

namespace generic;

use ReflectionMethod;

class Acao {
    const POST = "POST";
    const GET = "GET";
    const PUT = "PUT";
    const PATCH = "PATCH";
    const DELETE = "DELETE";

    private $endpoint;

    public function __construct($endpoint = [])
    {
        $this->endpoint = $endpoint;
    }

    public function executar()
    {
        $end = $this->endpointMetodo();

        if ($end) {
            $reflectionMetodo = new ReflectionMethod($end->classe, $end->execucao);
            $parametros = $reflectionMetodo->getParameters();
            $returnParam = $this->getParam();
            
            if ($parametros) {
                $para = [];
                foreach ($parametros as $v) {
                    $name = $v->getName();
                    if (!isset($returnParam[$name])) {
                        return false;
                    }
                    $para[$name] = $returnParam[$name];
                }
                return $reflectionMetodo->invokeArgs(new $end->classe(), $para);
            } else {
                return $reflectionMetodo->invoke(new $end->classe());
            }
        }
        return null;
    }

    private function endpointMetodo()
    {
        return isset($this->endpoint[$_SERVER["REQUEST_METHOD"]]) ? $this->endpoint[$_SERVER["REQUEST_METHOD"]] : null;
    }

    private function getPost() {
        if ($_POST) {
            return $_POST;
        }
        return [];
    }
    
    private function getGet() {
        if ($_GET) {
            $get = $_GET;
            unset($get["param"]);
            return $get;
        }
        return [];
    }

    private function getInput() {
        $input = file_get_contents("php://input");
        
        if ($input) {
            return json_decode($input, true);
        }
        return [];
    }

    public function getParam() {
        return array_merge($this->getPost(), $this->getGet(), $this->getInput());
    }
}