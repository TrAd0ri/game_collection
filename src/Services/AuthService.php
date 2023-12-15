<?php

require_once __DIR__ . '/../Models/Database.php';

function getUserByEmail($email)
{
  global $db;

  $query = $db->prepare('SELECT * FROM gamer WHERE email_gamer = :email');
  $query->execute(['email' => $email]);

  $user = $query->fetch();
  return formatUser($user);
}

function getUserById($id)
{
  global $db;

  $query = $db->prepare('SELECT * FROM gamer WHERE id_gamer = :id');
  $query->execute(['id' => $id]);

  $user = $query->fetch();
  return formatUser($user);
}

function createUser($email, $password, $surname, $name)
{
  global $db;

  $query = $db->prepare('INSERT INTO gamer (email_gamer, password_gamer, surname_gamer, name_gamer) VALUES (:email, :password, :surname, :name)');
  $query->execute([
    'email' => $email,
    'password' => $password,
    'surname' => $surname,
    'name' => $name,
  ]);

  return getUserById($db->lastInsertId());
}

function formatUser($user)
{
  return [
    'id' => $user['id_gamer'] ?? null,
    'email' => $user['email_gamer'] ?? null,
    'password' => $user['password_gamer'] ?? null,
    'surname' => $user['surname_gamer'] ?? null,
    'name' => $user['name_gamer'] ?? null,
  ];
}