<?php

// PUT api/password.php : change le mot de passe de l'utilisateur connecté
// Corps JSON attendu : { "old_password": "...", "new_password": "..." }

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/api.php';
require_once __DIR__ . '/../includes/data/purchases.php';

require_method('PUT');
$user_id = api_require_login();

$body = read_json_body();
$old_password = $body['old_password'] ?? '';
$new_password = $body['new_password'] ?? '';

if (!is_string($old_password) || !is_string($new_password) || $old_password === '' || $new_password === '') {
    json_error('Ancien et nouveau mot de passe requis.', 400);
}

if (strlen($new_password) < 8) {
    json_error('Le nouveau mot de passe doit contenir au moins 8 caractères.', 400);
}

$result = update_password($pdo, $user_id, $old_password, $new_password);

if ($result === 'wrong_password') {
    json_error('Ancien mot de passe incorrect.', 401);
}

if ($result !== 'ok') {
    json_error('Utilisateur introuvable.', 404);
}

session_regenerate_id(true);

json_response(['message' => 'Mot de passe mis à jour avec succès.']);