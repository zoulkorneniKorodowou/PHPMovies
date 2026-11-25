<?php

// GET    api/cart.php              : contenu du panier et total
// POST   api/cart.php              : ajoute un film    { "movie_id": 3 }
// DELETE api/cart.php?movie_id=3   : retire un film
// DELETE api/cart.php              : vide le panier

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/api.php';
require_once __DIR__ . '/../includes/data/cart.php';

$user_id = api_require_login();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $items = get_cart_items($pdo, $user_id);

    json_response([
        'items' => $items,
        'count' => count($items),
        'total' => get_cart_total($items),
    ]);
}

if ($method === 'POST') {
    $body = read_json_body();
    $movie_id = filter_var($body['movie_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if ($movie_id === false) {
        json_error('movie_id invalide.', 400);
    }
    if (!movie_exists($pdo, $movie_id)) {
        json_error('Film introuvable.', 404);
    }
    if (has_purchased($pdo, $user_id, $movie_id)) {
        json_error('Vous avez déjà acheté ce film.', 409);
    }
    if (!add_to_cart($pdo, $user_id, $movie_id)) {
        json_error('Ce film est déjà dans votre panier.', 409);
    }

    json_response(['movie_id' => $movie_id, 'message' => 'Film ajouté au panier.'], 201);
}

if ($method === 'DELETE') {
    if (!isset($_GET['movie_id'])) {
        clear_cart($pdo, $user_id);
        json_response(['message' => 'Panier vidé.']);
    }

    $movie_id = filter_var($_GET['movie_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if ($movie_id === false) {
        json_error('movie_id invalide.', 400);
    }
    if (!remove_from_cart($pdo, $user_id, $movie_id)) {
        json_error('Ce film n\'est pas dans votre panier.', 404);
    }

    json_response(['message' => 'Film retiré du panier.']);
}

json_error('Méthode non autorisée.', 405);