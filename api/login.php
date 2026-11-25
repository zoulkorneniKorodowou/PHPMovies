<?php

// POST api/login.php : connecte un utilisateur
// Corps JSON attendu : { "email": "...", "password": "..." }

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/api.php';
require_once __DIR__ . '/../includes/data/users.php';

require_method('POST');

$body = read_json_body();
$email = $body['email'] ?? '';
$password = $body['password'] ?? '';

if (!is_string($email) || !is_string($password) || trim($email) === '' || $password === '') {
    json_error('Email et mot de passe requis.', 400);
}

$user = find_user_by_email($pdo, trim($email));

if ($user === null || !password_verify($password, $user['password_hash'])) {
    json_error('Email ou mot de passe incorrect.', 401);
}

login_user($user);

json_response([
    'id_user'  => (int) $user['id_user'],
    'username' => $user['username'],
    'email'    => $user['email'],
]);