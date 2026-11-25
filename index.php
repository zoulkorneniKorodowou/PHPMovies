<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data/movies.php';

$movies = get_movies($pdo, '', 8);

$pageTitle = 'Accueil - WônouMovies';
$pageDescription = 'Découvrez les films à la une et notre catalogue de films cultes sur WônouMovies.';
require_once 'includes/header.php';
?>

<section>
    <h1 style="margin-bottom: 24px;">Films à la une</h1>

    <?php if (empty($movies)): ?>
        <p>Aucun film disponible pour le moment.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($movies as $movie): ?>
                <?php include 'includes/movie_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>