<?php
header("Content-Type: application/json");
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
  http_response_code(401);
  echo json_encode(["error" => "No autenticado"]);
  exit;
}

$stmt = $pdo->prepare("SELECT nombre, email, purchases FROM users WHERE id=?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode(["user" => $user]);
