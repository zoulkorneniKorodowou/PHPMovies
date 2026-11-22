USE phpmovies;
DROP TABLE IF EXISTS purchases;
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS users;

/*Compte utilisateurs*/
CREATE TABLE users (
    id_user            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username      VARCHAR(50)  NOT NULL,
    email         VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,              
    created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user),
    UNIQUE KEY uq_users_username (username),
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*panier de film d'un utilisateur*/
CREATE TABLE cart_items (
    user_id  INT UNSIGNED NOT NULL,
    movie_id INT UNSIGNED NOT NULL,
    added_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, movie_id),                  
    CONSTRAINT fk_cart_items_user FOREIGN KEY (user_id)
        REFERENCES users (id_user) ON DELETE CASCADE,      
    CONSTRAINT fk_cart_items_movie FOREIGN KEY (movie_id)
        REFERENCES movies (id_movie) ON DELETE CASCADE      
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*historique d'achat afficher sur le profil d'un utilisateur*/
CREATE TABLE purchases (
    id_purchase  INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id      INT UNSIGNED NOT NULL,
    movie_id     INT UNSIGNED NOT NULL,
    price_paid   DECIMAL(6,2) NOT NULL,               
    purchased_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_purchase),
    UNIQUE KEY uq_purchases_user_movie (user_id, movie_id),  
    CONSTRAINT fk_purchases_user FOREIGN KEY (user_id)
        REFERENCES users (id_user) ON DELETE CASCADE,
    CONSTRAINT fk_purchases_movie FOREIGN KEY (movie_id)
        REFERENCES movies (id_movie) ON DELETE RESTRICT     
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;