<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the existing connection script
require_once 'conexao.php';
$con->set_charset("utf8");

// Decode JSON input (not used, but kept for consistency)
json_decode(file_get_contents('php://input'), true);

// SQL to select all Perfis
$sql = "SELECT idPerfil, nmPerfil, dePerfil FROM Perfil";

$result = $con->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response[] = [
        "idPerfil" => 0,
        "nmPerfil" => "",
        "dePerfil" => ""
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);

$con->close();
?>
