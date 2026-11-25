<?php

// GET api/me.php : renvoie le profil de l'utilisateur connecté

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/api.php';
require_once __DIR__ . '/../includes/data/users.php';

require_method('GET');

$user_id = api_require_login();
$user = find_user_by_id($pdo, $user_id);

if ($user === null) {
    json_error('Utilisateur introuvable.', 404);
}

json_response($user);