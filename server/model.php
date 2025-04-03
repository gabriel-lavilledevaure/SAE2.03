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
    // et on renvoie le tout.
    return $res; // Retourne les résultats
}

function addMovie($titre, $real, $annee, $duree, $des, $cat, $img, $url, $age){
    try {
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age)
                VALUES (:name, :director, :year, :length, :description, :category, :image, :url, :age_rating)";
        $stmt = $cnx->prepare($sql);
        
        $stmt->bindParam(':name', $titre);
        $stmt->bindParam(':director', $real);
        $stmt->bindParam(':year', $annee);
        $stmt->bindParam(':length', $duree);
        $stmt->bindParam(':description', $des);
        $stmt->bindParam(':category', $cat);
        $stmt->bindParam(':image', $img);
        $stmt->bindParam(':trailer', $url);
        $stmt->bindParam(':min_age', $age);

        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        return ['error' => $e->getMessage()];
    }
}



