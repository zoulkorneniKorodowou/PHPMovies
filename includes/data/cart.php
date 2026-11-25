<?php

// Indique si un film existe dans le catalogue
function movie_exists(PDO $pdo, int $movie_id): bool
{
    $stmt = $pdo->prepare('SELECT 1 FROM movies WHERE id_movie = :movie_id');
    $stmt->execute(['movie_id' => $movie_id]);

    return $stmt->fetchColumn() !== false;
}

// Indique si l'utilisateur a déjà acheté ce film
function has_purchased(PDO $pdo, int $user_id, int $movie_id): bool
{
    $stmt = $pdo->prepare(
        'SELECT 1 FROM purchases
         WHERE user_id = :user_id AND movie_id = :movie_id'
    );
    $stmt->execute(['user_id' => $user_id, 'movie_id' => $movie_id]);

    return $stmt->fetchColumn() !== false;
}

// Renvoie les films du panier de l'utilisateur, du plus récent au plus ancien
function get_cart_items(PDO $pdo, int $user_id): array
{
    $stmt = $pdo->prepare(
        'SELECT m.id_movie, m.title, m.price, m.poster, c.added_at
         FROM cart_items c
         JOIN movies m ON m.id_movie = c.movie_id
         WHERE c.user_id = :user_id
         ORDER BY c.added_at DESC'
    );
    $stmt->execute(['user_id' => $user_id]);

    return $stmt->fetchAll();
}

// Calcule le total d'une liste de films du panier
function get_cart_total(array $items): float
{
    $total = 0.0;

    foreach ($items as $item) {
        $total += (float) $item['price'];
    }

    return $total;
}

// Ajoute un film au panier ; renvoie false s'il y était déjà
function add_to_cart(PDO $pdo, int $user_id, int $movie_id): bool
{
    $stmt = $pdo->prepare(
        'INSERT IGNORE INTO cart_items (user_id, movie_id)
         VALUES (:user_id, :movie_id)'
    );
    $stmt->execute(['user_id' => $user_id, 'movie_id' => $movie_id]);

    return $stmt->rowCount() === 1;
}

// Retire un film du panier ; renvoie false s'il n'y était pas
function remove_from_cart(PDO $pdo, int $user_id, int $movie_id): bool
{
    $stmt = $pdo->prepare(
        'DELETE FROM cart_items
         WHERE user_id = :user_id AND movie_id = :movie_id'
    );
    $stmt->execute(['user_id' => $user_id, 'movie_id' => $movie_id]);

    return $stmt->rowCount() === 1;
}

// Vide entièrement le panier de l'utilisateur
function clear_cart(PDO $pdo, int $user_id): void
{
    $stmt = $pdo->prepare('DELETE FROM cart_items WHERE user_id = :user_id');
    $stmt->execute(['user_id' => $user_id]);
}