let HOST_URL = "..";

let DataComment = {};

/** DataComment.getComments
 *
 * Récupère les commentaires en attente depuis le serveur via une requête HTTP GET.
 * La requête inclut un paramètre todo=getCommentAttente pour spécifier l'action côté serveur.
 *
 * @returns {Promise<Object>} Une promesse contenant les données des commentaires en attente.
 */
DataComment.getComments = async function () {
  let res = await fetch(`${HOST_URL}/server/script.php?todo=getCommentAttente`);
  return await res.json();
};

/** DataComment.approveComment
 *
 * Approuve un commentaire en envoyant son identifiant au serveur via une requête HTTP POST.
 * La requête inclut un paramètre todo=approveComment pour spécifier l'action côté serveur.
 *
 * @param {number|string} id L'identifiant du commentaire à approuver.
 * @returns {Promise<Object>} Une promesse contenant la réponse du serveur.
 */
DataComment.approveComment = async function (id) {
  let fd = new FormData();
  fd.append("id", id);
  let res = await fetch(`${HOST_URL}/server/script.php?todo=approveComment`, {
    method: "POST",
    body: fd,
  });
  return await res.json();
};

/** DataComment.removeComment
 *
 * Supprime un commentaire en envoyant son identifiant au serveur via une requête HTTP POST.
 * La requête inclut un paramètre todo=removeComment pour spécifier l'action côté serveur.
 *
 * @param {number|string} id L'identifiant du commentaire à supprimer.
 * @returns {Promise<Object>} Une promesse contenant la réponse du serveur.
 */
DataComment.removeComment = async function (id) {
  let fd = new FormData();
  fd.append("id", id);
  let res = await fetch(`${HOST_URL}/server/script.php?todo=removeComment`, {
    method: "POST",
    body: fd,
  });
  return await res.json();
};

export { DataComment };
