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

function addMovie($titre, $real, $annee, $duree, $des, $cat, $img, $url, $age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "REPLACE INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
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



