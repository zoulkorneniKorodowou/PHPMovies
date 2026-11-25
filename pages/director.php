<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/data/directors.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || (int) $_GET['id'] <= 0) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$id = (int) $_GET['id'];
$director = get_director_by_id($pdo, $id);

if ($director == null) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$movies = $director['movies'];
$pageTitle = $director['name'] . ' - WônouMovies';
$pageDescription = !empty($director['bio'])
    ? mb_substr($director['bio'], 0, 155)
    : 'Découvrez la filmographie du réalisateur ' . $director['name'] . ' sur WônouMovies.';
require_once __DIR__ . '/../includes/header.php';
?>

<section>
    <div style="margin-bottom: 24px;">
        <h1><?php echo htmlspecialchars($director['name']); ?></h1>
        <?php if (!empty($director['bio'])): ?>
            <p style="margin-top: 8px;"><?php echo htmlspecialchars($director['bio']); ?></p>
        <?php endif; ?>
    </div>

    <h2 style="margin-bottom: 20px;">Films réalisés (<?php echo count($movies); ?>)</h2>

    <?php if (empty($movies)): ?>
        <p>Aucun film trouvé pour ce réalisateur.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($movies as $movie): ?>
                <?php include __DIR__ . '/../includes/movie_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>