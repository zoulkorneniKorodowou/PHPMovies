<?php

// Retire un film du panier

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/cart.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/pages/cart.php');
}

require_login();
csrf_check();

$movie_id = filter_var($_POST['movie_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($movie_id !== false && remove_from_cart($pdo, current_user_id(), $movie_id)) {
    set_flash('success', 'Film retiré du panier.');
} else {
    set_flash('error', 'Ce film n\'est pas dans votre panier.');
}

redirect('/pages/cart.php');