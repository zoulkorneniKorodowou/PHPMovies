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
    <div class="hero-bg" style="background-image: url('<?= e(BASE_URL . '/' . $heroMovie['poster']) ?>');" aria-hidden="true"></div>
    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-inner">
        <div class="hero-text">
            <h1>Vos films cultes, <span class="hero-highlight">en quelques clics</span></h1>
            <p>
                Explorez notre sélection de films d'action et de drames, retrouvez vos réalisateurs
                préférés et achetez vos vidéos en toute simplicité.
            </p>
            <div class="hero-actions">
                <a href="#films-a-la-une" class="btn btn-primary btn-lg">Parcourir les films</a>
                <a href="<?= e(BASE_URL) ?>/pages/category.php?slug=action" class="btn btn-outline btn-lg">Action</a>
                <a href="<?= e(BASE_URL) ?>/pages/category.php?slug=drame" class="btn btn-outline btn-lg">Drame</a>
            </div>
        </div>

        <a href="<?= e(BASE_URL) ?>/pages/movie.php?id=<?= (int) $heroMovie['id_movie'] ?>" class="hero-feature">
            <img src="<?= e(BASE_URL . '/' . $heroMovie['poster']) ?>"
                 alt="Affiche de <?= e($heroMovie['title']) ?>" width="260" height="390">
            <span class="hero-feature-caption">
                <span>À l'affiche</span>
                <strong><?= e($heroMovie['title']) ?></strong>
            </span>
        </a>
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