<?php
/**
 * Carte d'un film, à inclure dans une boucle foreach.
 * @var array $movie Le film à afficher (id_movie, title, poster, price)
 */
?>
<div class="movie-card">
    <a href="<?= e(BASE_URL) ?>/pages/movie.php?id=<?= (int) $movie['id_movie'] ?>">
        <img src="<?= e(BASE_URL . '/' . $movie['poster']) ?>"
             alt="Affiche de <?= e($movie['title']) ?>" loading="lazy">
    </a>

    <div class="movie-card-info">
        <h3>
            <a href="<?= e(BASE_URL) ?>/pages/movie.php?id=<?= (int) $movie['id_movie'] ?>">
                <?= e($movie['title']) ?>
            </a>
        </h3>

        <div class="movie-card-bottom">
            <span class="price"><?= number_format((float) $movie['price'], 2, ',', ' ') ?> €</span>

            <form action="<?= e(BASE_URL) ?>/actions/cart_add.php" method="post">
                <input type="hidden" name="movie_id" value="<?= (int) $movie['id_movie'] ?>">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button type="submit" class="btn btn-primary btn-sm"aria-label="Ajouter <?= e($movie['title']) ?> au panier">+ Panier</button>            
            </form>
        </div>
    </div>
</div>

