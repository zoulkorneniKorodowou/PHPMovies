<?php

require_once '../config/database.php';
require_once '../includes/api.php';
require_once '../includes/data/directors.php';

require_method('GET');

if (!isset($_GET['id'])) {
    json_error('Paramètre id manquant', 400);
}

$id = $_GET['id'];

if (!is_numeric($id) || (int) $id <= 0) {
    json_error('Identifiant de réalisateur invalide', 400);
}

$director = get_director_by_id($pdo, (int) $id);

if ($director == null) {
    json_error('Réalisateur non trouvé', 404);
}

json_response($director, 200);
