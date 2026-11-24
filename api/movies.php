<?php

require_once '../config/database.php';
require_once '../includes/api.php';
require_once '../includes/data/movies.php';

require_method('GET');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!is_numeric($id) || (int) $id <= 0) {
        json_error('Identifiant de film invalide', 400);
    }

    $movie = get_movie_by_id($pdo, (int) $id);

    if ($movie == null) {
        json_error('Film non trouvé', 404);
    }

    json_response($movie, 200);
}

$category_slug = '';
if (isset($_GET['category'])) {
    $category_slug = trim($_GET['category']);
    $category = get_category_by_slug($pdo, $category_slug);

    if ($category == null) {
        json_error('Catégorie non trouvée', 404);
    }
}

$limit = 0;
if (isset($_GET['limit'])) {
    if (!is_numeric($_GET['limit']) || (int) $_GET['limit'] <= 0) {
        json_error('Le paramètre limit doit être un nombre positif', 400);
    }
    $limit = (int) $_GET['limit'];
}

$movies = get_movies($pdo, $category_slug, $limit);
json_response($movies, 200);
