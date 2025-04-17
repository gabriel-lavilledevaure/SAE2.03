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
  const id_user = parseInt(select.value);

  let noteForm = "";
  if (!dejaNote) {
    noteForm = `
      <div class="details__note-form">
        <label for="note-select">Notez ce film :</label>
        <select id="note-select">
          <option value="">-- Choisissez une note --</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button onclick="C.handlerSubmitNote(${movie.id})">Noter</button>
      </div>`;
  } else {
    noteForm = `<p class="details__note-already">Vous avez déjà noté ce film ✅</p>`;
  }

  movieHtml = movieHtml.replace("{{noteForm}}", noteForm);

  let commentsHtml = "";
  if (comments.length) {
    for (let c of comments) {
      const dateObj = new Date(c.time_post);
      const dateLocale = dateObj.toLocaleString("fr-FR", {
        dateStyle: "medium",
        timeStyle: "short",
      });

      const auteur = c.user_name ? c.user_name : `Utilisateur ${c.id_user}`;
      const imgSrc = c.user_image ? `../server/images/${c.user_image}` : "";

      commentsHtml += `
        <div class="commentaire__item">
          <img class="commentaire__avatar" src="${imgSrc}" alt="profil" />
          <div class="commentaire__content">
            <span class="commentaire__auteur">${auteur}</span>
            <span class="commentaire__date">${dateLocale}</span>
            <p class="commentaire__texte">${c.commentary}</p>
          </div>
        </div>`;
    }
  } else {
    commentsHtml = `<p>Aucun commentaire pour ce film. Soyez le premier à en laisser un !</p>`;
  }

  const commentForm = `
  <div class="commentaire__form">
    <textarea id="comment-text" class="commentaire__textarea" placeholder="Écrivez votre commentaire ici..." rows="3"></textarea>
    <button class="commentaire__button" onclick="C.handlerSubmitComment(${id_user}, ${movie.id})">Envoyer</button>
  </div>`;

  movieHtml += `
  <div class="commentaire">
    <h3 class="commentaire__titre">Commentaires</h3>
    <div id="comments-container" class="commentaire__liste">${commentsHtml}</div>
    ${commentForm}
  </div>
`;

  return movieHtml;
};

export { Moviedetails };
