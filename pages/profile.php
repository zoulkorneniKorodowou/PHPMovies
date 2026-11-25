<?php

// Page profil : achats de l'utilisateur et changement de mot de passe

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/data/purchases.php';

$user_id = current_user_id();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $old_password = is_string($_POST['old_password'] ?? null) ? $_POST['old_password'] : '';
    $new_password = is_string($_POST['new_password'] ?? null) ? $_POST['new_password'] : '';
    $confirm_password = is_string($_POST['confirm_password'] ?? null) ? $_POST['confirm_password'] : '';

    if ($old_password === '' || $new_password === '' || $confirm_password === '') {
        $error = 'Tous les champs sont obligatoires.';
    } elseif ($new_password !== $confirm_password) {
        $error = 'Les nouveaux mots de passe ne correspondent pas.';
    } elseif (strlen($new_password) < 8) {
        $error = 'Le nouveau mot de passe doit contenir au moins 8 caractères.';
    } else {
        $result = update_password($pdo, $user_id, $old_password, $new_password);

        if ($result === 'ok') {
            session_regenerate_id(true);
            $success = 'Votre mot de passe a été modifié avec succès.';
        } elseif ($result === 'wrong_password') {
            $error = "L'ancien mot de passe est incorrect.";
        } else {
            $error = 'Une erreur est survenue.';
        }
    }
}

$purchases = get_purchases($pdo, $user_id);
$pageTitle = 'Mon Profil - WônouMovies';
$pageDescription = "Retrouvez l'historique de vos films achetés et gérez votre mot de passe sur WônouMovies.";
require_once __DIR__ . '/../includes/header.php';
?>

<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1>Mon Profil</h1>
        <a href="<?php echo BASE_URL; ?>/actions/logout.php" class="btn btn-outline">Déconnexion</a>
    </div>

    <div style="margin-bottom: 40px;">
        <h2 style="margin-bottom: 16px;">Mes films achetés (<?php echo count($purchases); ?>)</h2>

        <?php if (empty($purchases)): ?>
            <p>Vous n'avez encore acheté aucun film.</p>
        <?php else: ?>
            <div class="movies-grid">
                <?php foreach ($purchases as $movie): ?>
                    <?php include __DIR__ . '/../includes/movie_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-container" style="max-width: 500px;">
        <h2 style="margin-bottom: 16px;">Changer mon mot de passe</h2>

        <?php if ($error !== ''): ?>
            <div class="flash flash--error" style="margin-bottom: 16px;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if ($success !== ''): ?>
            <div class="flash flash--success" style="margin-bottom: 16px;">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="form-group">
                <label for="old_password">Ancien mot de passe</label>
                <input type="password" id="old_password" name="old_password" required autocomplete="current-password">            </div>

            <div class="form-group">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" id="new_password" name="new_password" required minlength="8" autocomplete="new-password">            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="8" autocomplete="new-password">            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>