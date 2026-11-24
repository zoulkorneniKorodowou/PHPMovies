<?php 
//POST api/register.php : cree un compte $utilisateurs
require_once __DIR__ .'/../config/database.php';
require_once __DIR__ .'/../includes/api.php';
require_once __DIR__ .'/../includes/data/users.php';

require_method('POST');

$body = read_json_body();
$username = $body['username'] ?? '';
$email = $body['email'] ??'';
$password = $body['password'] ??'';

if (!is_string($username) || !is_string($email) || !is_string($password)) {
    json_error('Donnees invalides.', 400);
}
$username = trim($username);
$email = trim($email);

if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
    json_error('Le pseudo doit contenir 3 à 30 caractères (lettres, chiffres ou _).', 400);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_error('Adresse email invalide.', 400);
}

if (strlen($password) < 8) {
    json_error('Le mot de passe doit contenir au moins 8 caractères.', 400);
}

if (find_user_by_username($pdo, $username) !== null) {
    json_error('Ce pseudo est déjà utilisé.', 409);
}
if (find_user_by_email($pdo, $email) !== null) {
    json_error('Cette adresse email est déjà utilisée.', 409);
}

$user_id = create_user($pdo, $username, $email, $password);
json_response([
    'id_user'  => $user_id,
    'username' => $username,
    'email'    => $email,
], 201);