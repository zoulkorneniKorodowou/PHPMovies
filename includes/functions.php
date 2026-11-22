<?php

// on demarre la session une seule fois, avec un cookie proteger
if (session_status()=== PHP_SESSION_NONE){
    session_set_cookie_params([
        'httponly' =>true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Protege un texte avant de l'afficher dans le HTML (contre la faille XSS)
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES,'UTF-8');
}

$_SESSION['USER_id'] = 5;
//Indique si un utilisateur est connecter
function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

//Renvoie l'id de l'utilisateur connecter, ou null si personne n'est connecter 
function current_user_id(): ?int {
    if (!is_logged_in()) {
        return null;
    } else {
        return (int) $_SESSION['user_id'];
    }

}