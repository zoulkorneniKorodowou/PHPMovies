<?php

// Page de résultats de recherche (formulaire du header : ?q=...)

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/search.php';

$query = is_string($_GET['q'] ?? null) ? trim($_GET['q']) : '';
$movies = [];
$error = '';

if ($query !== '') {
    if (mb_strlen($query) < 2) {
        $error = 'Tapez au moins 2 caractères.';
    } elseif (mb_strlen($query) > 100) {
        $error = 'Votre recherche est trop longue (100 caractères maximum).';
    } else {
        $movies = search_movies($pdo, $query);
    }
}

$count = count($movies);
$pageTitle = $query !== '' ? 'Recherche : ' . $query . ' - PHPMovies' : 'Recherche - PHPMovies';
require __DIR__ . '/../includes/header.php';
?>

<section class="search-page">
    <h1>Rechercher un film</h1>

    <form action="<?= e(BASE_URL) ?>/pages/search.php" method="get" class="search-page-form" role="search">
        <label for="search-q" class="visually-hidden">Titre ou réalisateur</label>
        <input type="search" id="search-q" name="q"
               value="<?= e($query) ?>"
               placeholder="Titre ou réalisateur (ex. Nolan, Matrix…)"
               minlength="2" maxlength="100" required>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <?php if ($error !== ''): ?>
        <div class="alert alert-error" role="alert"><?= e($error) ?></div>
    <?php elseif ($query !== ''): ?>
        <p class="search-count" role="status">
            <?php if ($count === 0): ?>
                Aucun résultat pour « <strong><?= e($query) ?></strong> ».
            <?php else: ?>
                <?= $count ?> résultat<?= $count > 1 ? 's' : '' ?> pour « <strong><?= e($query) ?></strong> »
            <?php endif; ?>
        </p>

        <?php if ($count > 0): ?>
            <div class="movies-grid">
                <?php foreach ($movies as $movie): ?>
                    <?php include __DIR__ . '/../includes/movie_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="search-empty">
                <p>Essayez avec un autre titre ou le nom d'un réalisateur.</p>
                <a href="<?= e(BASE_URL) ?>/index.php" class="btn btn-outline">Retour à l'accueil</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>