<?php 
function find_user_by_email(PDO $pdo, string $email): ?array {
    $stmt = $pdo->prepare(
        'SELECT id_user, username, email, password_hash
        FROM users
        WHERE email = :email'
    );
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user ===false) {
        return null;
    }
    return $user;
}

//Renvoie l'utilisateur qui a ce pseudo, ou null s'il n'existe pas
function find_user_by_username(PDO $pdo, string $username): ?array {
    $stmt = $pdo->prepare(
        'SELECT id_user, username, email, password_hash
        FROM users
        WHERE username = :username'
    );
    $stmt->execute(['username'=> $username]);
    $user = $stmt->fetch();
    if ($user === false) {
        return null;
    }
    return $user;
}

//Cree un compte et renvoie son id
function create_user(PDO $pdo, string $username, string $email, string $password): int {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare
    (
        'INSERT INTO users (username, email, password_hash)
        VALUES (:username, :email, :password_hash)'
    );
    $stmt->execute([
        'username'=> $username,
        'email'=> $email,
        'password_hash'=> $password_hash,
    ]);
    return (int) $pdo->lastInsertId();
}

// Renvoie le profil public d'un utilisateur (sans mot de passe), ou null
function find_user_by_id(PDO $pdo, int $id_user): ?array
{
    $stmt = $pdo->prepare(
        'SELECT id_user, username, email, created_at
         FROM users
         WHERE id_user = :id_user'
    );
    $stmt->execute(['id_user' => $id_user]);
    $user = $stmt->fetch();

    if ($user === false) {
        return null;
    }

    return $user;
}