# PHPMovies

Site de vente de films en ligne réalisé en PHP et MySQL dans le cadre d'un projet scolaire en binôme.

On peut parcourir les films par catégorie (Action, Drame), voir le détail d'un film et de son réalisateur, et faire une recherche par titre ou par réalisateur. Une fois connecté, on peut ajouter des films à son panier, les acheter et les retrouver sur son profil.

## Technologies

- PHP 8 (sans framework), PDO
- MySQL / MariaDB
- HTML et CSS
- XAMPP
- Postman pour tester l'API

## Installation

1. Cloner le projet dans le dossier `htdocs` de XAMPP :

   ```
   cd C:\xampp\htdocs\PROJET_PHP
   git clone https://github.com/zoulkorneniKorodowou/PHPMovies.git
   ```

2. Copier `config/database.example.php` en `config/database.php` et l'adapter si besoin (identifiants MySQL, `BASE_URL`).

3. Démarrer Apache et MySQL, puis importer dans phpMyAdmin les scripts du dossier `sql/` dans l'ordre :

   ```
   01_catalogue.sql
   02_users.sql
   03_fixtures_catalogue.sql
   04_fixtures_casting.sql
   ```

4. Ouvrir http://localhost/PROJET_PHP/PHPMovies/ et créer un compte depuis la page Inscription.

## API

Toutes les routes sont dans le dossier `api/` et renvoient du JSON.

- Comptes : `register.php`, `login.php`, `logout.php`, `me.php`
- Catalogue : `movies.php`, `directors.php`, `search.php`
- Panier : `cart.php` (GET, POST, DELETE)
- Achats : `checkout.php`, `purchases.php`, `password.php`

Les collections Postman et l'environnement sont dans `docs/postman/`. Il suffit de les importer dans Postman et de choisir l'environnement local.

## Sécurité

Requêtes préparées, mots de passe hachés, protection XSS et CSRF, sessions sécurisées, et accès bloqué aux dossiers `config/`, `includes/` et `sql/`.

## Auteurs

- zoulkorneniKorodowou : catalogue, réalisateurs, profil, achat, interface
- lawsondjeckylaurenne : comptes, panier, recherche, page 404, documentation