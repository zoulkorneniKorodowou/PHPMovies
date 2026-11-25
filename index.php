<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data/movies.php';

$movies = get_movies($pdo, '', 8);
$heroMovie = !empty($movies) ? $movies[0] : null;

$pageTitle = 'Accueil - WônouMovies';
$pageDescription = 'Découvrez les films à la une et notre catalogue de films cultes sur WônouMovies.';
require_once 'includes/header.php';
?>

<?php if ($heroMovie !== null): ?>
<section class="hero">
    <div class="hero-bg" style="background-image: url('<?= htmlspecialchars(BASE_URL . '/' . $heroMovie['poster']) ?>');" aria-hidden="true"></div>
    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-content">
        <span class="hero-badge">À l'affiche sur WônouMovies</span>
        <h1><?= htmlspecialchars($heroMovie['title']) ?></h1>
        <p>
            Explorez notre catalogue de films cultes et de nouveautés : parcourez nos genres,
            recherchez vos réalisateurs favoris et achetez vos vidéos en quelques clics.
        </p>
        <div class="hero-actions">
            <a href="#films-a-la-une" class="btn btn-primary">Voir plus</a>
            <a href="<?= htmlspecialchars(BASE_URL) ?>/pages/movie.php?id=<?= (int) $heroMovie['id_movie'] ?>" class="btn btn-outline">Découvrir ce film</a>
        </div>
    </div>
</section>
<?php endif; ?>

<section id="films-a-la-une" class="featured-section">
    <h2 class="section-title">Films à la une</h2>

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