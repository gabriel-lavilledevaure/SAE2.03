let templateFile = await fetch("./component/Moviedetails/template.html");
let template = await templateFile.text();

let Moviedetails = {};

Moviedetails.format = function (
  movie,
  noteMoyenne = null,
  dejaNote = false,
  comments = []
) {
  let movieHtml = template;

  movieHtml = movieHtml.replace("{{titre}}", movie.name);
  movieHtml = movieHtml.replace("{{image}}", movie.image);
  movieHtml = movieHtml.replace("{{desc}}", movie.description);
  movieHtml = movieHtml.replace("{{realisateur}}", movie.director);
  movieHtml = movieHtml.replace("{{annee}}", movie.year);
  movieHtml = movieHtml.replace("{{duree}}", movie.length);
  movieHtml = movieHtml.replace("{{categorie}}", movie.category_name);
  movieHtml = movieHtml.replace("{{age}}", movie.min_age);
  movieHtml = movieHtml.replace("{{url}}", movie.trailer);
  movieHtml = movieHtml.replace("{{moyenne}}", noteMoyenne ?? "Aucune note");

  const select = document.querySelector("#profile-select");
  const id_user = parseInt(select.dataset.id);

  let commentsHtml = "";
  if (comments.length) {
    for (let c of comments) {
      const auteur = c.user_name ? c.user_name : `Utilisateur ${c.id_user}`;
      const imgSrc = c.user_image
        ? `https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03/server/images/${c.user_image}`
        : "";
      commentsHtml += `
        <div class="comment" style="display: flex; align-items: center; margin-bottom: 1rem;">
          <img src="${imgSrc}" alt="profil" width="40" height="40" style="border-radius: 50%; margin-right: 0.5rem;">
          <div>
            <strong>${auteur}</strong><br>
            <p>${c.commentary}</p>
          </div>
        </div>`;
    }
  } else {
    commentsHtml = `<p>Aucun commentaire pour ce film. Soyez le premier à en laisser un !</p>`;
  }

  const commentForm = `
    <textarea id="comment-text" placeholder="Écrivez votre commentaire ici..." rows="3" style="width: 100%; margin-top: 1rem;"></textarea>
    <button onclick="C.handlerSubmitComment(${id_user}, ${movie.id})">Envoyer</button>
  `;

  movieHtml += `
    <div class="commentaire">
      <h3>Commentaires</h3>
      <div id="comments-container">${commentsHtml}</div>
      <div id="comment-form">${commentForm}</div>
    </div>
  `;

  return movieHtml;
};

export { Moviedetails };
