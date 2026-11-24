<?php

function get_purchases($pdo, $user_id)
{
    $sql = 'SELECT movies.*, categories.name AS category_name, categories.slug AS category_slug, purchases.price_paid, purchases.purchased_at
            FROM purchases
            JOIN movies ON purchases.movie_id = movies.id_movie
            JOIN categories ON movies.category_id = categories.id_category
            WHERE purchases.user_id = :user_id
            ORDER BY purchases.purchased_at DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll();
}

function update_password($pdo, $user_id, $old_password, $new_password)
{
    $sql = 'SELECT password_hash FROM users WHERE id_user = :id_user';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_user' => $user_id]);
    $user = $stmt->fetch();

    if ($user == false) {
        return 'user_not_found';
    }

    if (!password_verify($old_password, $user['password_hash'])) {
        return 'wrong_password';
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_sql = 'UPDATE users SET password_hash = :password_hash WHERE id_user = :id_user';
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute([
        'password_hash' => $hashed_password,
        'id_user' => $user_id
    ]);

    return 'ok';
}