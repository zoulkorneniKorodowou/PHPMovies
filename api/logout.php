<?php

// POST api/logout.php : déconnecte l'utilisateur courant

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/api.php';

require_method('POST');

logout_user();

json_response(['message' => 'Déconnexion réussie.']);