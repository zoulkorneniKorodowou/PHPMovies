<?php

// Page d'inscription : affiche le formulaire (GET) et le traite (POST)

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/data/users.php';

// Un utilisateur déjà connecté n'a rien à faire ici
if (is_logged_in()) {
    redirect('/pages/profile.php');
}

$errors = [];
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
    $email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
    $password_confirm = is_string($_POST['password_confirm'] ?? null) ? $_POST['password_confirm'] : '';

    // Pseudo : format, puis disponibilité
    if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
        $errors['username'] = 'Le pseudo doit contenir 3 à 30 caractères (lettres, chiffres ou _).';
    } elseif (find_user_by_username($pdo, $username) !== null) {
        $errors['username'] = 'Ce pseudo est déjà utilisé.';
    }

    // Email : format, puis disponibilité
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Adresse email invalide.';
    } elseif (find_user_by_email($pdo, $email) !== null) {
        $errors['email'] = 'Cette adresse email est déjà utilisée.';
    }

    // Mot de passe : longueur, puis confirmation
    if (strlen($password) < 8) {
        $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractères.';
    } elseif ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Les deux mots de passe ne correspondent pas.';
    }

    if (empty($errors)) {
        create_user($pdo, $username, $email, $password);
        set_flash('success', 'Compte créé ! Vous pouvez maintenant vous connecter.');
        redirect('/pages/login.php');
    }
}

$pageTitle = 'Inscription - WônouMovies';
$pageDescription = 'Créez gratuitement votre compte sur WônouMovies pour acheter vos films préférés.';
require __DIR__ . '/../includes/header.php';
?>

<section class="form-container">
    <h1>Créer un compte</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error" role="alert">
            Le formulaire contient des erreurs. Corrigez les champs indiqués.
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <div class="form-group">
            <label for="username">Pseudo</label>
            <input type="text" id="username" name="username"
                   value="<?= e($username) ?>"
                   required minlength="3" maxlength="30" pattern="[A-Za-z0-9_]+"
                   autocomplete="username"
                   aria-describedby="username-help"
                   <?= isset($errors['username']) ? 'aria-invalid="true"' : '' ?>>
            <small id="username-help" class="form-help">3 à 30 caractères : lettres, chiffres ou _</small>
            <?php if (isset($errors['username'])): ?>
                <p class="form-error"><?= e($errors['username']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email"
                   value="<?= e($email) ?>"
                   required maxlength="255"
                   autocomplete="email"
                   <?= isset($errors['email']) ? 'aria-invalid="true"' : '' ?>>
            <?php if (isset($errors['email'])): ?>
                <p class="form-error"><?= e($errors['email']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"
                   required minlength="8"
                   autocomplete="new-password"
                   aria-describedby="password-help"
                   <?= isset($errors['password']) ? 'aria-invalid="true"' : '' ?>>
            <small id="password-help" class="form-help">8 caractères minimum</small>
            <?php if (isset($errors['password'])): ?>
                <p class="form-error"><?= e($errors['password']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm"
                   required minlength="8"
                   autocomplete="new-password"
                   <?= isset($errors['password_confirm']) ? 'aria-invalid="true"' : '' ?>>
            <?php if (isset($errors['password_confirm'])): ?>
                <p class="form-error"><?= e($errors['password_confirm']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Créer mon compte</button>
        </div>
    </form>

    <p class="form-footer">
        Déjà inscrit ? <a href="<?= e(BASE_URL) ?>/pages/login.php">Se connecter</a>
    </p>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>