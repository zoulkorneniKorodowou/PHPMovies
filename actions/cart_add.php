<?php

// Ajoute un film au panier depuis le site (bouton « + Panier »)

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/cart.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/index.php');
}

require_login();
csrf_check();

$user_id = current_user_id();
$movie_id = filter_var($_POST['movie_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($movie_id === false || !movie_exists($pdo, $movie_id)) {
    set_flash('error', 'Film introuvable.');
    redirect('/index.php');
}

if (has_purchased($pdo, $user_id, $movie_id)) {
    set_flash('error', 'Vous possédez déjà ce film.');
    redirect('/pages/profile.php');
}

if (add_to_cart($pdo, $user_id, $movie_id)) {
    set_flash('success', 'Film ajouté au panier.');
} else {
    set_flash('error', 'Ce film est déjà dans votre panier.');
}

redirect('/pages/cart.php');