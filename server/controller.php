<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");



function readController(){
    // Appel de la fonction getMovie déclarée dans model.php pour extraire de la BDD les informations des films
    $movies = getMovie();
    return $movies;
}

/**
 * Fonction de contrôle pour lire les informations d'un film en fonction de son id.
 * 
 * @return array|false Les informations du film ou false en cas d'erreur.
 */
function readControllerMovieinfos(){
  // Récupération des paramètres de la requête
  // On utilise l'opérateur de coalescence nulle (??) pour assigner une valeur par défaut si la clé n'existe pas
  $id = $_REQUEST['id'] ?? null;

  if (empty($id)) {
      return "Erreur : Tous les champs doivent être remplis.";
  }

  return getMovieinfos($id);
}

/**
 * Fonction de contrôle pour lire les informations d'un film en fonction de sa catégorie.
 * 
 * @return array|false Les informations du film ou false en cas d'erreur.
 */
function readControllerMoviecategorie(){
  // Récupération des paramètres de la requête
  // On utilise l'opérateur de coalescence nulle (??) pour assigner une valeur par défaut si la clé n'existe pas
  $categorie = $_REQUEST['categorie'] ?? null;

  if (empty($categorie)) {
      return "Erreur : Tous les champs doivent être remplis.";
  }

  return getMoviecategorie($categorie);
}

function addController(){
    /* Lecture des données de formulaire
      On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
      vérifiées avant de les envoyer 
    */


    // Récupération des paramètres de la requête
    $titre = $_REQUEST['titre'] ?? null;
    $realisateur = $_REQUEST['realisateur'] ?? null;
    $annee = $_REQUEST['annee'] ?? null;
    $duree = $_REQUEST['duree'] ?? null;
    $desc = $_REQUEST['desc'] ?? null;
    $categorie = $_REQUEST['categorie'] ?? null;
    $image = $_REQUEST['image'] ?? null;
    $url = $_REQUEST['url'] ?? null;
    $age = $_REQUEST['age'] ?? null;

    // Validation: Check if any parameter is empty
    if (empty($titre) || empty($realisateur) || empty($annee) || empty($duree) || empty($desc) || empty($categorie) || empty($image) || empty($url) || empty($age)) {
        return "Erreur : Tous les champs doivent être remplis.";
    }
    // Mise à jour du menu à l'aide de la fonction updateMenu décrite dans model.php
    $ok = addMovie($titre, $realisateur, $annee, $duree, $desc, $categorie, $image, $url, $age);
    // $ok est le nombre de ligne affecté par l'opération de mise à jour dans la BDD (voir model.php)
    if ($ok!=0){
      return "Le film $titre a été ajouté avec succès !";
    } 
    else{
      return "Erreur lors de l'ajout du film $titre !";
    }
  }

  
  

