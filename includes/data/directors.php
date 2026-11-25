<?php

function get_director_by_id($pdo, $id)
{
    $sql = 'SELECT * FROM directors WHERE id_director = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $director = $stmt->fetch();

    if ($director == false) {
        return null;
    }

    $director['movies'] = get_movies_by_director($pdo, $id);
    return $director;
}

function get_movies_by_director($pdo, $director_id)
{
    $sql = 'SELECT movies.*, categories.name AS category_name, categories.slug AS category_slug 
            FROM movies 
            JOIN categories ON movies.category_id = categories.id_category 
            WHERE movies.director_id = :director_id 
            ORDER BY movies.release_year DESC, movies.id_movie ASC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['director_id' => $director_id]);
    return $stmt->fetchAll();
}
