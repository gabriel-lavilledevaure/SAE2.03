<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
// Ces constantes sont utilisées pour établir une connexion à la base de données.
define("HOST", "localhost");
define("DBNAME", "lavilledevaur1");
define("DBLOGIN", "lavilledevaur1");
define("DBPWD", "lavilledevaur1");


function getMovie(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le nom, l'image et l'id du film
    $sql = "SELECT id, name, image FROM Movie";

    // exécution de la requête SQL via la connexion à la bdd et récupération de la réponse sur serveur MySQL
    $answer = $cnx->query($sql);
    // conversion des lignes récupérées en tableau d'objets (chaque ligne devient un objet)
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function getProfiles(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le nom, l'image et l'id du film
    $sql = "SELECT id, name, image, datenaissance FROM User";

    // exécution de la requête SQL via la connexion à la bdd et récupération de la réponse sur serveur MySQL
    $answer = $cnx->query($sql);
    // conversion des lignes récupérées en tableau d'objets (chaque ligne devient un objet)
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function getMovieinfos($id){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les informations du film en fonction du nom
    $sql = "SELECT Movie.id, Movie.name, image, description, director, year, length, Category.name AS category_name, min_age, trailer 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id 
            WHERE Movie.id = :id
";

    // Préparation de la requête SQL
    $stmt = $cnx->prepare($sql);
    // Liaison du paramètre :id avec la variable $id
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    // Exécution de la requête
    $stmt->execute(); 
    // Conversion des lignes récupérées en tableau d'objets (chaque ligne devient un objet)
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

/**
 * Fonction pour récupérer toutes les catégories de films
 * 
 * @return array Un tableau d'objets contenant les noms des catégories
 */
function getAllCategories() {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les noms de toutes les catégories
    $sql = "SELECT name FROM Category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}



function getMoviecategorie($categorie){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les informations du film en fonction du nom
    $sql = "SELECT Movie.id, Movie.name, image 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id 
            WHERE LOWER(Category.name) = LOWER(:categorie)
";

    // Préparation de la requête SQL
    $stmt = $cnx->prepare($sql);
    // Liaison du paramètre :id avec la variable $categorie){
    $stmt->bindParam(':categorie', $categorie   , PDO::PARAM_STR);
    // Exécution de la requête
    $stmt->execute(); 
    // Conversion des lignes récupérées en tableau d'objets (chaque ligne devient un objet)
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}
/**
 * Fonction pour récupérer les films en fonction de l'âge
 * 
 * @param int $age L'âge de l'utilisateur
 * @return array Un tableau d'objets contenant les films accessibles à cet âge
 */
function getMoviesByAge($age) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT id, name, image, min_age FROM Movie WHERE min_age <= :age";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getLikesUserMovie($id_user){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT id_user, id_movie FROM Likes WHERE id_user = :id_user";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function addMovie($titre, $real, $annee, $duree, $des, $cat, $img, $url, $age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
            VALUES (:titre, :realisateur, :annee, :duree, :desc, :categorie, :image, :url, :age)";

    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':realisateur', $real);
    $stmt->bindParam(':annee', $annee);
    $stmt->bindParam(':duree', $duree);
    $stmt->bindParam(':desc', $des);
    $stmt->bindParam(':categorie', $cat);
    $stmt->bindParam(':image', $img);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':age', $age);

    $stmt->execute();
    $res = $stmt->rowCount();
    return $res; // Retourne le nombre de lignes affectées par l'opération
}

function addUser($name, $image, $datenaissance) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO User (name, image, datenaissance) 
            VALUES (:name, :image, :datenaissance)";

    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':datenaissance', $datenaissance);

    $stmt->execute();
    $res = $stmt->rowCount();
    return $res; // Retourne le nombre de lignes affectées par l'opération
}

function addLikes($user, $movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Likes (id_user, id_movie) 
            VALUES (:id_user, :id_movie)";

    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':id_user', $user);
    $stmt->bindParam(':id_movie', $movie);

    $stmt->execute();
    $res = $stmt->rowCount();
    return $res; // Retourne le nombre de lignes affectées par l'opération
}

/**
 * Fonction pour récupérer les films en fonction de l'âge et de la catégorie
 * 
 * @param int $age L'âge de l'utilisateur
 * @param string $categorie La catégorie de film
 * @return array Un tableau d'objets contenant les films accessibles à cet âge et dans cette catégorie
 */
function getMoviesAgeCategory($age, $categorie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, Movie.image
            FROM Movie
            INNER JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.min_age <= :age AND LOWER(Category.name) = LOWER(:categorie)";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Fonction pour mettre à jour les informations d'un utilisateur
 * 
 * @param int $id L'identifiant de l'utilisateur
 * @param string $name Le nom de l'utilisateur
 * @param string $image L'image de l'utilisateur
 * @param string $datenaissance La date de naissance de l'utilisateur
 * @return int Le nombre de lignes affectées par la mise à jour
 */
function updateUser($id, $name, $image, $datenaissance) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "UPDATE User SET name = :name, image = :image, datenaissance = :datenaissance WHERE id = :id";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':datenaissance', $datenaissance);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->rowCount(); // Retourne 1 si ok, 0 sinon
}

function checkUser($name) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT COUNT(*) FROM User WHERE name = :name";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0; // retourne true si au moins un utilisateur existe avec ce nom
}

function removeLikes($user, $movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "DELETE FROM Likes WHERE id_user = :id_user AND id_movie = :id_movie";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_user', $user);
    $stmt->bindParam(':id_movie', $movie);
    $stmt->execute();

    return $stmt->rowCount(); // retourne 1 si un like a été supprimé
}
