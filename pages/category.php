<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/data/movies.php';

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header('Location: ../index.php');
    exit;
}

$slug = trim($_GET['slug']);
$category = get_category_by_slug($pdo, $slug);

if ($category == null) {
    header('Location: ../index.php');
    exit;
}

$movies = get_movies($pdo, $slug);
$pageTitle = 'Films ' . htmlspecialchars($category['name']) . ' - PHPMovies';
require_once '../includes/header.php';
?>

<section>
    <h2 style="margin-bottom: 24px;">Catégorie : <?php echo htmlspecialchars($category['name']); ?></h2>

    <?php if (empty($movies)): ?>
        <p>Aucun film trouvé dans cette catégorie.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($movies as $movie): ?>
                <?php include '../includes/movie_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once '../includes/footer.php'; ?>