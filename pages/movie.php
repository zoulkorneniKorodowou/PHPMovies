<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/data/movies.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$movieId = (int) $_GET['id'];
$movie = get_movie_by_id($pdo, $movieId);

if ($movie == null) {
    header('Location: ../index.php');
    exit;
}

$csrfToken = '';
if (isset($_SESSION['csrf_token'])) {
    $csrfToken = $_SESSION['csrf_token'];
}

$pageTitle = htmlspecialchars($movie['title']) . ' - PHPMovies';
require_once '../includes/header.php';
?>

<div class="movie-detail">
    <img src="<?php echo BASE_URL; ?>/<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">

    <div class="movie-detail-info">
        <h1><?php echo htmlspecialchars($movie['title']); ?></h1>

        <p><strong>Réalisateur :</strong>
            <a href="<?= BASE_URL ?>/pages/director.php?id=<?= (int) $movie['director_id'] ?>">
            <?= htmlspecialchars($movie['director_name']) ?>
            </a>
        </p>

        <p><strong>Année :</strong> <?php echo $movie['release_year']; ?></p>
        <p><strong>Durée :</strong> <?php echo $movie['duration']; ?> min</p>
        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($movie['category_name']); ?></p>
        <p><?php echo htmlspecialchars($movie['synopsis']); ?></p>

        <?php if (!empty($movie['actors'])): ?>
            <p><strong>Acteurs :</strong>
                <?php
                $totalActors = count($movie['actors']);
                $i = 0;
                foreach ($movie['actors'] as $actor) {
                    echo htmlspecialchars($actor['name']);
                    $i++;
                    if ($i < $totalActors) {
                        echo ', ';
                    }
                }
                ?>
            </p>
        <?php endif; ?>

        <p class="price"><?php echo $movie['price']; ?> €</p>

        <form action="<?php echo BASE_URL; ?>/actions/cart_add.php" method="POST">
            <input type="hidden" name="movie_id" value="<?php echo $movie['id_movie']; ?>">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
            <button type="button" class="btn-add-cart" data-id="<?= (int) $movie['id_movie'] ?>" data-base-url="<?= BASE_URL ?>">
                + Panier
            </button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>