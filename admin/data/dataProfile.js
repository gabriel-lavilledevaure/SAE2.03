// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03";

let DataProfile = {};

/**
 * Récupère tous les profils depuis le serveur
 */
DataProfile.requestProfiles = async function () {
  let res = await fetch(HOST_URL + "/server/script.php?todo=getProfiles");
  let data = await res.json();
  return data;
};

/**
 * Ajoute un nouveau profil
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
 * Met à jour un profil existant
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

export { DataProfile };
