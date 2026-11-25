<?php

// Cherche les films dont le titre OU le nom du réalisateur contient le texte donné
function search_movies(PDO $pdo, string $query): array
{
    // % et _ sont des jokers en SQL : on les neutralise pour chercher le texte tel quel
    $like = '%' . addcslashes($query, '%_\\') . '%';

    $stmt = $pdo->prepare(
        'SELECT m.id_movie, m.title, m.price, m.poster, m.release_year,
                d.name AS director_name
         FROM movies m
         JOIN directors d ON d.id_director = m.director_id
         WHERE m.title LIKE :title OR d.name LIKE :director
         ORDER BY m.title
         LIMIT 50'
    );
    $stmt->execute(['title' => $like, 'director' => $like]);

    return $stmt->fetchAll();
}