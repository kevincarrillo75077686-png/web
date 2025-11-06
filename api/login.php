<?php
header("Content-Type: application/json");
require "db.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data["email"] ?? "");
$password = $data["password"] ?? "";

$stmt = $pdo->prepare("SELECT id, nombre, password_hash FROM users WHERE email=?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password_hash"])) {
  $_SESSION["user_id"] = $user["id"];
  $_SESSION["nombre"] = $user["nombre"];
  echo json_encode(["success" => true]);
} else {
  http_response_code(401);
  echo json_encode(["error" => "Email o contraseña incorrectos"]);
}
