<?php
header("Content-Type: application/json");
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
  http_response_code(401);
  echo json_encode(["error" => "No autenticado"]);
  exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$nombre = trim($data["nombre"] ?? "");
if (!$nombre) {
  http_response_code(400);
  echo json_encode(["error" => "Nombre vacío"]);
  exit;
}

$stmt = $pdo->prepare("UPDATE users SET nombre=? WHERE id=?");
$stmt->execute([$nombre, $_SESSION["user_id"]]);
$_SESSION["nombre"] = $nombre;
echo json_encode(["success" => true]);
