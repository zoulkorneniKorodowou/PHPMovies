<?php

function get_movies($pdo, $category_slug = '', $limit = 0)
{
    if ($category_slug != '') {
        $sql = 'SELECT movies.*, categories.name AS category_name, categories.slug AS category_slug 
                FROM movies 
                JOIN categories ON movies.category_id = categories.id_category 
                WHERE categories.slug = :slug 
                ORDER BY movies.id_movie ASC';

        if ($limit > 0) {
            $sql = $sql . ' LIMIT ' . (int) $limit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['slug' => $category_slug]);
        return $stmt->fetchAll();
    }

    $sql = 'SELECT movies.*, categories.name AS category_name, categories.slug AS category_slug 
            FROM movies 
            JOIN categories ON movies.category_id = categories.id_category 
            ORDER BY movies.id_movie ASC';

    if ($limit > 0) {
        $sql = $sql . ' LIMIT ' . (int) $limit;
    }

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function get_movie_by_id($pdo, $id)
{
    $sql = 'SELECT movies.*, directors.name AS director_name, categories.name AS category_name 
            FROM movies 
            JOIN directors ON movies.director_id = directors.id_director 
            JOIN categories ON movies.category_id = categories.id_category 
            WHERE movies.id_movie = :id';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $movie = $stmt->fetch();

    if ($movie == false) {
        return null;
    }

    $sql_actors = 'SELECT actors.id_actor, actors.name 
                   FROM actors 
                   JOIN movie_actor ON actors.id_actor = movie_actor.actor_id 
                   WHERE movie_actor.movie_id = :id';

    $stmt_actors = $pdo->prepare($sql_actors);
    $stmt_actors->execute(['id' => $id]);
    $movie['actors'] = $stmt_actors->fetchAll();

    return $movie;
}

function get_categories($pdo)
{
    $stmt = $pdo->query('SELECT * FROM categories ORDER BY name ASC');
    return $stmt->fetchAll();
}

function get_category_by_slug($pdo, $slug)
{
    $sql = 'SELECT * FROM categories WHERE slug = :slug';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['slug' => $slug]);
    $category = $stmt->fetch();

    if ($category == false) {
        return null;
    }

    return $category;
}
