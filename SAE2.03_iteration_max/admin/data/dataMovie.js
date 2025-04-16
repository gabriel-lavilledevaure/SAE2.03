// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";

let DataMovie = {};

/** DataMovie.add
 *
 * Envoie un nouveau film au serveur via une requête HTTP POST.
 * La requête inclut un paramètre todo=addMovie pour déclencher l'ajout côté serveur.
 *
 * @param {*} fdata un objet FormData contenant les données du film à envoyer.
 * @returns la réponse du serveur.
 */
DataMovie.add = async function (fdata) {
  let config = {
    method: "POST",
    body: fdata,
  };

  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addMovie",
    config
  );
  let data = await answer.json();
  return data;
};

/** DataMovie.update
 *
 * Prend en paramètre un objet FormData (données de formulaire) à envoyer au serveur.
 * Ces données sont incluses dans une requête HTTP en méthode POST.
 * Une requête POST au lieu de GET n'affiche pas les données dans l'URL (plus discret).
 * Les données sont placées dans le corps (body) de la requête HTTP. Elles restent visibles mais
 * en utilisant les outils de développement du navigateur (Network > Payload).
 * La requête comprend aussi un paramètre todo valant update pour indiquer au serveur qu'il
 * s'agit d'une mise à jour (car on a codé le serveur pour qu'il sache quoi faire en fonction de la valeur de todo).
 *
 * @param {*} fdata un objet FormData contenant les données du formulaire à envoyer au serveur.
 * @returns la réponse du serveur.
 */
DataMovie.update = async function (fdata) {
  let config = {
    method: "POST",
    body: fdata,
  };

  let answer = await fetch(HOST_URL + "/server/script.php?todo=update", config);
  console.log(answer); // debug
  let data = await answer.json();
  return data;
};

/** DataMovie.searchMovies
 *
 * Envoie une requête au serveur pour rechercher des films contenant un mot-clé dans leur titre,
 * année ou catégorie. La requête utilise la méthode GET.
 *
 * @param {string} valeur le mot-clé à rechercher.
 * @returns un tableau d’objets contenant les films correspondants.
 */
DataMovie.searchMovies = async function (valeur) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=searchMovies&titre=" + valeur
  );
  let data = await answer.json();
  return data;
};

/** DataMovie.toggleRecoStatus
 *
 * Modifie le statut de recommandation d’un film (0 ou 1).
 * Utilise une requête HTTP POST avec les paramètres id et reco envoyés dans le corps de la requête.
 * Le paramètre todo=updateMovieReco permet d’identifier l’action côté serveur.
 *
 * @param {number} id l’identifiant du film.
 * @param {string|number} status le nouveau statut (0 ou 1).
 * @returns la réponse du serveur.
 */
DataMovie.toggleRecoStatus = async function (id, status) {
  const fd = new FormData();
  fd.append("id", id);
  fd.append("reco", status);
  console.log("DataMovie.toggleRecoStatus", fd); // debug
  const response = await fetch(
    HOST_URL + "/server/script.php?todo=updateMovieReco",
    {
      method: "POST",
      body: fd,
    }
  );
  let data = await response.json();
  return data;
};

// On exporte la fonction DataMovie.requestMovies
export { DataMovie };
