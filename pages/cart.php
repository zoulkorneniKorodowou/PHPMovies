<?php

// Page panier : réservée aux utilisateurs connectés

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/data/cart.php';

$items = get_cart_items($pdo, current_user_id());
$total = get_cart_total($items);
$count = count($items);

$pageTitle = 'Mon panier - PHPMovies';
require __DIR__ . '/../includes/header.php';
?>

<section class="cart">
    <h1 class="cart-title">Mon panier</h1>

    <?php if ($count === 0): ?>
        <div class="cart-empty">
            <p>Votre panier est vide.</p>
            <a href="<?= e(BASE_URL) ?>/index.php" class="btn btn-primary">Découvrir les films</a>
        </div>
    <?php else: ?>
        <ul class="cart-list">
            <?php foreach ($items as $item): ?>
                <li class="cart-item">
                    <a href="<?= e(BASE_URL) ?>/pages/movie.php?id=<?= (int) $item['id_movie'] ?>" class="cart-item-poster">
                        <img src="<?= e(BASE_URL . '/' . $item['poster']) ?>"
                             alt="Affiche de <?= e($item['title']) ?>" loading="lazy">
                    </a>

                    <div class="cart-item-info">
                        <h2>
                            <a href="<?= e(BASE_URL) ?>/pages/movie.php?id=<?= (int) $item['id_movie'] ?>">
                                <?= e($item['title']) ?>
                            </a>
                        </h2>
                        <p class="cart-item-price"><?= number_format((float) $item['price'], 2, ',', ' ') ?> €</p>
                    </div>

                    <form action="<?= e(BASE_URL) ?>/actions/cart_remove.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="movie_id" value="<?= (int) $item['id_movie'] ?>">
                        <button type="submit" class="btn btn-outline btn-sm"
                                aria-label="Retirer <?= e($item['title']) ?> du panier">Retirer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <aside class="cart-summary">
            <p class="cart-total">
                <span>Total (<?= $count ?> film<?= $count > 1 ? 's' : '' ?>)</span>
                <strong><?= number_format($total, 2, ',', ' ') ?> €</strong>
            </p>

            <form action="<?= e(BASE_URL) ?>/actions/checkout.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button type="submit" class="btn btn-primary">Valider l'achat</button>
            </form>

            <form action="<?= e(BASE_URL) ?>/actions/cart_clear.php" method="post"
                  onsubmit="return confirm('Vider tout le panier ?');">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button type="submit" class="btn btn-outline">Vider le panier</button>
            </form>
        </aside>
    <?php endif; ?>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>