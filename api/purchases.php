<?php

require_once '../config/database.php';
require_once '../includes/api.php';
require_once '../includes/data/purchases.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_method('GET');

if (!isset($_SESSION['user_id'])) {
    json_error('Utilisateur non authentifié', 401);
}

$purchases = get_purchases($pdo, (int) $_SESSION['user_id']);
json_response($purchases, 200);
