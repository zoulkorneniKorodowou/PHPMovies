<?php

// Page « introuvable » : affichée par Apache pour toute adresse inexistante

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

http_response_code(404);

$pageTitle = 'Page introuvable - PHPMovies';
require __DIR__ . '/../includes/header.php';
?>

<section class="error-page">
    <p class="error-code" aria-hidden="true">404</p>
    <h1>Cette page est introuvable</h1>
    <p>Le film ou la page que vous cherchez n'existe pas, ou a été déplacé.</p>

    <form action="<?= e(BASE_URL) ?>/pages/search.php" method="get" class="search-page-form" role="search">
        <label for="error-q" class="visually-hidden">Rechercher un film</label>
        <input type="search" id="error-q" name="q" placeholder="Rechercher un film…" minlength="2" maxlength="100" required>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <a href="<?= e(BASE_URL) ?>/index.php" class="btn btn-outline">Retour à l'accueil</a>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>