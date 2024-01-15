<?php

require_once dirname(__DIR__) . "/loadEnv.php";
require_once dirname(__DIR__, 2) . "/models/GameModel.php";

$id_game = $_POST['id'] ?? null;
$id_gamer = $_SESSION["user_id"] ?? null;

if (!$id_game || !$id_gamer) {
  header("Location: ../../library?error=true");
  return;
}

try {
  addGameToUserLibrary($id_game, $id_gamer);
  header("Location: ../../game?id=$id_game");
} catch (Exception $e) {
  header("Location: ../../library?error=true");
  return;
}
