<?php

require_once '../config/database.php';
require_once '../includes/api.php';
require_once '../includes/data/purchases.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_method('PUT');

if (!isset($_SESSION['user_id'])) {
    json_error('Utilisateur non authentifié', 401);
}

$data = json_decode(file_get_contents('php://input'), true);

$old_password = $data['old_password'] ?? '';
$new_password = $data['new_password'] ?? '';

if (empty($old_password) || empty($new_password)) {
    json_error('Ancien et nouveau mot de passe requis', 400);
}

if (strlen($new_password) < 6) {
    json_error('Le nouveau mot de passe doit contenir au moins 6 caractères', 400);
}

$result = update_password($pdo, (int) $_SESSION['user_id'], $old_password, $new_password);

if ($result === 'wrong_password') {
    json_error('Ancien mot de passe incorrect', 401);
}

if ($result !== 'ok') {
    json_error('Utilisateur introuvable', 404);
}

json_response(['message' => 'Mot de passe mis à jour avec succès'], 200);