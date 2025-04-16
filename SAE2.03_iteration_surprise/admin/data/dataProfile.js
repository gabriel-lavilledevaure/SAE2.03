// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";

let DataProfile = {};

/**
 * DataProfile.add
 *
 * Prend en paramètre un objet FormData (données de formulaire) à envoyer au serveur.
 * Ces données sont incluses dans une requête HTTP en méthode POST.
 * La requête comprend aussi un paramètre todo valant add pour indiquer au serveur qu'il
 * s'agit d'une création (car on a codé le serveur pour qu'il sache quoi faire en fonction de la valeur de todo).
 *
 * @param {*} fdata un objet FormData contenant les données du formulaire à envoyer au serveur.
 * @returns la réponse du serveur.
 */
DataProfile.add = async function (fdata) {
  let config = {
    method: "POST",
    body: fdata,
  };

  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addProfile",
    config
  );
  let data = await answer.json();
  return data;
};

/**
 * DataProfile.update
 *
 * Prend en paramètre un objet FormData (données de formulaire) à envoyer au serveur.
 * Ces données sont incluses dans une requête HTTP en méthode POST.
 * La requête comprend aussi un paramètre todo valant update pour indiquer au serveur qu'il
 * s'agit d'une mise à jour (car on a codé le serveur pour qu'il sache quoi faire en fonction de la valeur de todo).
 *
 * @param {*} fdata un objet FormData contenant les données du formulaire à envoyer au serveur.
 * @returns la réponse du serveur.
 */
DataProfile.update = async function (fdata) {
  let config = {
    method: "POST",
    body: fdata,
  };
  let res = await fetch(
    HOST_URL + "/server/script.php?todo=updateProfile",
    config
  );
  return await res.json();
};

/**
 * DataProfile.getAllProfiles
 *
 * Envoie une requête HTTP au serveur pour récupérer la liste complète des profils utilisateurs.
 * Cette requête utilise la méthode GET et inclut un paramètre `todo` valant `getProfiles`
 * afin d’indiquer au serveur l’action à effectuer (lecture des profils).
 *
 * Cette fonction est utilisée pour afficher la liste des utilisateurs dans l’application,
 * par exemple dans un menu de sélection de profil ou pour des opérations liées à la personnalisation.
 *
 * @returns la reponse du serveur.
 */
DataProfile.getAllProfiles = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getProfiles");
  let data = await answer.json();
  return data;
};

export { DataProfile };
