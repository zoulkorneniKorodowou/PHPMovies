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

//envoie le visiteur vers une autre page du site, puis arrete le script
function redirect(string $path): void {
    header('Location: ' . BASE_URL . $path);
    exit;
}

//Range un message a afficher une seule fois sur la prochaine page
function set_flash(string $type, string $message): void {
    $_SESSION['flash']=[
        'type'=> $type,
        'message'=> $message,
    ];
}

//renvoie le message flash puis le supprime (null s'il n'y en a pas)
function get_flash(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;

}

//bloque la page aux visiteurs non connecter: ils sont renvoyer vers la connexion
function require_login(): void{
    if (!is_logged_in()){
        set_flash('error', 'Connectez-vous pour acceder a cette page.');
        redirect('/pages/login.php');
    }
}

// Renvoie le jeton anti-CSRF de la session (le creer s'il n'existe pas encore)
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

//Arrete tout si le formulaire envoyer ne contient pas le bon jeton anti-CSRF
function csrf_check():void {
    $token = $_POST['csrf_token'] ??'';
    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        http_response_code(403);
        exit('Requete invalide. Rechargez la page et reessayez.');
    }
}