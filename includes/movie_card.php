<?php
$token = '';
if (isset($_SESSION['csrf_token'])) {
    $token = $_SESSION['csrf_token'];
}
?>
<div class="movie-card">
    <a href="movie.php?id=<?php echo $movie['id_movie']; ?>">
        <img src="<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
    </a>

    <div class="movie-card-info">
        <h3>
            <a href="movie.php?id=<?php echo $movie['id_movie']; ?>">
                <?php echo htmlspecialchars($movie['title']); ?>
            </a>
        </h3>

        <div class="movie-card-bottom">
            <span class="price"><?php echo $movie['price']; ?> €</span>

            
            <form action="actions/cart_add.php" method="POST">
                <input type="hidden" name="movie_id" value="<?php echo $movie['id_movie']; ?>">
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                <button type="submit" class="btn btn-primary btn-sm">+ Panier</button>
            </form>
        </div>
    </div>
</div>
