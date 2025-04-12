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

function readControllerMoviesReco(){
  $age = $_REQUEST['age'] ?? 100;
  return getMovieReco($age);
}



function readControllerProfiles(){
    // Appel de la fonction getProfiles déclarée dans model.php pour extraire de la BDD les informations des films
    $profiles = getProfiles();
    return $profiles;
}

function readControllerSearchMovies() {
  $titre = $_REQUEST['titre'] ?? null;
  if (empty($titre)) return false;
  return searchMoviesTitre($titre);
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

/**
 * Fonction de contrôle pour lire les films en fonction de l'âge.
 * 
 * @return array|false Les informations des films ou false en cas d'erreur.
 */
function readControllerMoviesByAge() {
  $age = $_REQUEST['age'] ?? null;
  if ($age === null || !is_numeric($age)) {
      return false;
  }

  return getMoviesByAge((int)$age);
}


/**
 * Fonction de contrôle pour lire toutes les catégories de films.
 * 
 * @return array|false Les informations des catégories ou false en cas d'erreur.
 */
function readControllerCategories() {
  return getAllCategories();
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

  function readControllerMoviesAgeCategory() {
    $age = $_REQUEST['age'] ?? null;
    $categorie = $_REQUEST['categorie'] ?? null;
  
    if ($age === null || !is_numeric($age) || empty($categorie)) {
      return false;
    }
  
    return getMoviesAgeCategory($age, $categorie);
  }

  function readControllerLikesUserMovie() {
    $id_user = $_REQUEST['id_user'] ?? null;
  
    if ($id_user === null) {
      return false;
    }
  
    return getLikesUserMovie($id_user);
  }


  function addUserController(){
    $name = $_REQUEST['name'] ?? null;
    $image = $_REQUEST['image'] ?? null;
    $datenaissance = $_REQUEST['datenaissance'] ?? null;

    if (empty($name) || empty($image) || empty($datenaissance)) {
        return "Erreur : Tous les champs doivent être remplis.";
    }

    if (checkUser($name)) {
        return "Erreur : L'utilisateur \"$name\" existe déjà.";
    }

    $ok = addUser($name, $image, $datenaissance);
    if ($ok != 0){
        return "L'utilisateur $name a été ajouté avec succès !";
    } else {
        return "Erreur lors de l'ajout de l'utilisateur $name !";
    }
}


  function addLikesController(){
    /* Lecture des données de formulaire
      On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
      vérifiées avant de les envoyer 
    */

    // Récupération des paramètres de la requête
    $user = $_REQUEST['id_user'] ?? null;
    $movie = $_REQUEST['id_movie'] ?? null;

    // Validation: Check if any parameter is empty
    if (empty($user) || empty($movie)) {
        return "Erreur : Tous les champs doivent être remplis.";
    }
    // Mise à jour du menu à l'aide de la fonction updateMenu décrite dans model.php
    $ok = addLikes($user,$movie);
  }

  function updateUserController() {
    $id = $_REQUEST['id'] ?? null;
    $name = $_REQUEST['name'] ?? null;
    $image = $_REQUEST['image'] ?? null;
    $datenaissance = $_REQUEST['datenaissance'] ?? null;

    if (empty($id) || empty($name) || empty($datenaissance)) {
        return "Erreur : Tous les champs obligatoires doivent être remplis.";
    }

    $ok = updateUser($id, $name, $image, $datenaissance);
    return $ok ? "Le profil a été modifié avec succès." : "Erreur lors de la modification du profil.";
}

function removeLikesController(){
  $user = $_REQUEST['id_user'] ?? null;
  $movie = $_REQUEST['id_movie'] ?? null;

  if (empty($user) || empty($movie)) {
      return "Erreur : Tous les champs doivent être remplis.";
  }

  $ok = removeLikes($user, $movie);
  return $ok ? "Like supprimé" : "Aucun like à supprimer";
}

function updateControllerMovieReco() {
  $id = $_REQUEST['id'] ?? null;
  $reco = $_REQUEST['reco'] ?? null;

  if ($id === null || $reco === null || !is_numeric($id) || !in_array($reco, ['0','1'], true)) {
    return "Erreur : Paramètres invalides.";
  }

  $result = updateMovieRecoStatus($id,$reco);

  return $result
    ? "Le statut du film a été mis à jour avec succès."
    : "Erreur lors de la mise à jour du statut du film.";
}

function addNoteController() {
  $id_user = $_REQUEST['id_user'] ?? null;
  $id_movie = $_REQUEST['id_movie'] ?? null;
  $note = $_REQUEST['note'] ?? null;

  if (!$id_user || !$id_movie || $note === null) {
      return [ "error" => true, "message" => "Données manquantes." ];
  }

  if (checkUserNote($id_user, $id_movie)) {
      return [ "error" => true, "dejaNote" => true ];
  }

  $ok = addNote($id_user, $id_movie, $note);
  if ($ok) {
    return [ "success" => true, "message" => "Votre note a été enregistrée." ];
  } else {
    return [ "error" => true, "message" => "Erreur lors de l'enregistrement de la note." ];
  }
}


function getMoyenneNoteController() {
  $id_movie = $_REQUEST['id_movie'] ?? null;
  if (!$id_movie) return false;

  return getMoyenneNote($id_movie);
}

function checkUserNoteController() {
  $id_user = $_REQUEST['id_user'] ?? null;
  $id_movie = $_REQUEST['id_movie'] ?? null;
  if (!$id_user || !$id_movie) return false;

  $noted = checkUserNote($id_user, $id_movie);
  return ["dejaNote" => $noted]; 
}
