<?php

// Vide entièrement le panier

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/cart.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/pages/cart.php');
}

require_login();
csrf_check();

clear_cart($pdo, current_user_id());
set_flash('success', 'Votre panier a été vidé.');

redirect('/pages/cart.php');