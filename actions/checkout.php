<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/purchases.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/pages/cart.php');
    exit;
}

$result = checkout($pdo, (int) $_SESSION['user_id']);

if ($result === 'empty_cart') {
    if (function_exists('set_flash')) {
        set_flash('error', 'Votre panier est vide.');
    }
    header('Location: ' . BASE_URL . '/pages/cart.php');
    exit;
}

if ($result !== 'ok') {
    if (function_exists('set_flash')) {
        set_flash('error', 'Une erreur est survenue lors de la validation de votre achat.');
    }
    header('Location: ' . BASE_URL . '/pages/cart.php');
    exit;
}

if (function_exists('set_flash')) {
    set_flash('success', 'Merci pour votre achat ! Vos films sont disponibles dans votre profil.');
}
header('Location: ' . BASE_URL . '/pages/profile.php');
exit;
