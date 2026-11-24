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

//Cree un compte et renvoie son id
function create_user(PDO $pdo, $username, string $email, string $password): int {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare
    (
        'INSERT INTO USERS (username, email, password_hash)
        VALUES (:username, :email, :password_hash)'
    );
    $stmt->execute([
        'username'=> $username,
        'email'=> $email,
        'password_hash'=> $password_hash,
    ]);
    return (int) $pdo->lastInsertId();
}