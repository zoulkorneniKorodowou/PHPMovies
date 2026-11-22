<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged = isset($_SESSION['user_id']);

if (isset($pageTitle)) {
    $titre = htmlspecialchars($pageTitle);
} else {
    $titre = 'PHPMovies';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/forms.css">
</head>
<body>

<header class="header">
    <div class="header-container">
        <a href="index.php" class="logo"><span>Wônou</span>Movies</a>

        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Rechercher un film, réalisateur..." required>
            <button type="submit">Rechercher</button>
        </form>

        <button class="options-btn" id="options-btn" aria-label="Menu de navigation">☰</button>

        <nav class="nav-menu" id="nav-menu">
            <a href="index.php">Accueil</a>
            <a href="category.php?slug=action">Action</a>
            <a href="category.php?slug=drame">Drame</a>

            <?php if ($is_logged): ?>
                <a href="cart.php">Panier</a>
                <a href="profile.php">Mon Profil</a>
                <a href="actions/logout.php" class="btn btn-outline">Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline">Connexion</a>
                <a href="register.php" class="btn btn-primary">Inscription</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="main-container">

<?php if (function_exists('get_flash')): ?>
    <?php $flash = get_flash(); ?>
    <?php if ($flash !== null): ?>
        <div class="flash flash--<?php echo htmlspecialchars($flash['type']); ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
