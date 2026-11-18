DROP DATABASE IF EXISTS `phpmovies`;

CREATE DATABASE `phpmovies` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `phpmovies`;

/* Table des catégories */
CREATE TABLE `categories` (
    `id_category` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `slug` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_category`),
    CONSTRAINT `uq_categories_slug` UNIQUE (`slug`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/* Table des directeurs */
CREATE TABLE `directors` (
    `id_director` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `bio` TEXT NULL,
    `photo` VARCHAR(255) NULL,
    PRIMARY KEY (`id_director`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/* Table des films */
CREATE TABLE `movies` (
    `id_movie` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(150) NOT NULL,
    `synopsis` TEXT NOT NULL,
    `release_year` SMALLINT UNSIGNED NOT NULL,
    `duration` SMALLINT UNSIGNED NOT NULL, -- en minutes
    `price` DECIMAL(6, 2) NOT NULL,
    `poster` VARCHAR(255) NOT NULL,
    `trailer_youtube_id` VARCHAR(20) NULL,
    `director_id` INT UNSIGNED NOT NULL,
    `category_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_movie`),
    CONSTRAINT `fk_movies_director` FOREIGN KEY (`director_id`) REFERENCES `directors` (`id_director`) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_movies_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/* Table des acteurs */
CREATE TABLE `actors` (
    `id_actor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_actor`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

/* Table movie_actor */
CREATE TABLE `movie_actor` (
    `movie_id` INT UNSIGNED NOT NULL,
    `actor_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`movie_id`, `actor_id`),
    CONSTRAINT `fk_movie_actor_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_movie_actor_actor` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id_actor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;