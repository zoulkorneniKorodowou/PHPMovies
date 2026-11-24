<?php

require_once '../config/database.php';
require_once '../includes/api.php';
require_once '../includes/data/purchases.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_method('POST');

if (!isset($_SESSION['user_id'])) {
    json_error('Utilisateur non authentifié', 401);
}

$result = checkout($pdo, (int) $_SESSION['user_id']);

if ($result === 'empty_cart') {
    json_error('Votre panier est vide', 400);
}

if ($result !== 'ok') {
    json_error('Erreur lors de la validation de la commande', 500);
}

json_response(['message' => 'Achat validé avec succès'], 200);
