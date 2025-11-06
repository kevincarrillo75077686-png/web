<?php
header("Content-Type: application/json");
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
  http_response_code(401);
  echo json_encode(["error" => "No autenticado"]);
  exit;
}

$stmt = $pdo->prepare("UPDATE users SET purchases = purchases + 1 WHERE id=?");
$stmt->execute([$_SESSION["user_id"]]);

$stmt = $pdo->prepare("SELECT purchases FROM users WHERE id=?");
$stmt->execute([$_SESSION["user_id"]]);
$count = $stmt->fetchColumn();

echo json_encode(["purchases" => (int)$count]);
