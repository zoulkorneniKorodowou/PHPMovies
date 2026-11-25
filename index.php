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
    <div style="margin-bottom: 32px; padding: 24px; background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius);">
        <h1 style="margin-bottom: 10px;">Bienvenue sur WônouMovies</h1>
        <p style="color: var(--text-muted);">
            Explorez notre catalogue numérique de films cultes et de nouveautés : parcourez nos sélections par genre,
            recherchez vos réalisateurs favoris et achetez vos vidéos en quelques clics pour les retrouver à tout moment dans votre espace personnel.
        </p>
    </div>

    <h2 style="margin-bottom: 24px;">Films à la une</h2>

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