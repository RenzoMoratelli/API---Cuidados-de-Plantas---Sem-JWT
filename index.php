<?php 
include "generic/Autoload.php";

use generic\Controller;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if (isset($_GET["param"])) {
    $controller = new Controller();
    $controller->verificarChamadas($_GET["param"]);
} else {
    header("Content-Type: application/json");
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Nenhuma rota especificada"
    ]);
}