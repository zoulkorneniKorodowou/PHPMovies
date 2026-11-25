<?php

// Déconnexion depuis le site (formulaire POST du header)

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/index.php');
}

csrf_check();
logout_user();

// Nouvelle session vide, juste pour transporter le message flash
session_start();
set_flash('success', 'Vous êtes déconnecté. À bientôt !');

redirect('/index.php');