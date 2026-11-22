<?php

/* Envoie une réponse JSON de succès */
function json_response(mixed $data = null, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode([
        'success' => true,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/* Envoie une réponse JSON d'erreur */
function json_error(string $message, int $status = 400): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode([
        'success' => false,
        'error' => $message
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/* Lit et décode les données JSON envoyées dans le corps de la requête */
function read_json_body()
{
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    if (!empty($data)) {
        return $data;
    } else {
        return [];
    }
}

/* Vérifie que la méthode HTTP utilisée est la bonne */
function require_method($method)
{
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        json_error('Méthode ' . $method . ' requise', 405);
    }
}

/* Bloque la requête si l'utilisateur n'est pas connecté */
function api_require_login(): int
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['user_id'])) {
        json_error('Authentification requise pour effectuer cette action', 401);
    }

    return (int) $_SESSION['user_id'];
}
