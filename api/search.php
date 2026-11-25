<?php

// GET api/search.php?q=nolan : recherche par titre ou par réalisateur

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/api.php';
require_once __DIR__ . '/../includes/data/search.php';

require_method('GET');

$query = is_string($_GET['q'] ?? null) ? trim($_GET['q']) : '';

if (mb_strlen($query) < 2) {
    json_error('La recherche doit contenir au moins 2 caractères.', 400);
}
if (mb_strlen($query) > 100) {
    json_error('La recherche ne doit pas dépasser 100 caractères.', 400);
}

$results = search_movies($pdo, $query);

json_response([
    'query'   => $query,
    'count'   => count($results),
    'results' => $results,
]);