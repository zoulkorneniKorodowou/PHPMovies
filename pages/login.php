<?php

// Page de connexion : affiche le formulaire (GET) et le traite (POST)

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/users.php';

if (is_logged_in()) {
    redirect('/pages/profile.php');
}

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

    $user = $email !== '' ? find_user_by_email($pdo, $email) : null;

    if ($user === null || !password_verify($password, $user['password_hash'])) {
        $error = 'Email ou mot de passe incorrect.';
    } else {
        login_user($user);
        set_flash('success', 'Bon retour parmi nous, ' . $user['username'] . ' !');
        redirect('/index.php');
    }
}

$pageTitle = 'Connexion - WônouMovies';
$pageDescription = 'Connectez-vous à votre compte WônouMovies pour accéder à votre panier et vos achats.';
require __DIR__ . '/../includes/header.php';
?>

<section class="form-container">
    <h1>Connexion</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-error" role="alert"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email"
                   value="<?= e($email) ?>"
                   required autocomplete="email" autofocus>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"
                   required autocomplete="current-password">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>

    <p class="form-footer">
        Pas encore de compte ? <a href="<?= e(BASE_URL) ?>/pages/register.php">Créer un compte</a>
    </p>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>