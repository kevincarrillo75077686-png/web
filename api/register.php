<?php
header("Content-Type: application/json");
require "db.php";

$data = json_decode(file_get_contents("php://input"), true);
$nombre = trim($data["nombre"] ?? "");
$email = trim($data["email"] ?? "");
$password = $data["password"] ?? "";

if (!$nombre || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
  http_response_code(400);
  echo json_encode(["error" => "Datos inválidos"]);
  exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
  $stmt = $pdo->prepare("INSERT INTO users (nombre, email, password_hash) VALUES (?, ?, ?)");
  $stmt->execute([$nombre, $email, $hash]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  if ($e->errorInfo[1] === 1062) {
    http_response_code(409);
    echo json_encode(["error" => "El correo ya está registrado"]);
  } else {
    http_response_code(500);
    echo json_encode(["error" => "Error del servidor"]);
  }
}
