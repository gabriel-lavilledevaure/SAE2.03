let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movies, isLikesPage = false) {
  if (movies.length === 0) {
    return "<p>Il n'y a pas de films disponibles.</p>";
  }

  let html = "";
  for (let i = 0; i < movies.length; i++) {
    let movie = movies[i];
    let movieHtml = template;

    let now = new Date();
    let movieDate = new Date(movie.date_ajout);
    let diffInDays = (now - movieDate) / (1000 * 60 * 60 * 24);
    let isNew = diffInDays <= 7;

    if (isNew) {
      movieHtml = movieHtml.replace(
        "{{new}}",
        `<span class="card__new">NOUVEAU</span>`
      );
    } else {
      movieHtml = movieHtml.replace("{{new}}", "");
    }

    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace(
      "{{handlerFavoris}}",
      `C.handlerAddFavoris(${movie.id}, this)`
    );
    movieHtml = movieHtml.replace(
      "{{deleteHandler}}",
      `<button
         class="card__delete"
         data-id="${movie.id}"
         onclick="event.stopPropagation(); C.handlerDeleteLike(${movie.id}, this);"
         title="Supprimer des likes"
       >✖</button>`
    );

    movieHtml = movieHtml.replace(
      "{{handler}}",
      `C.handlerDetail(${movie.id}, this)`
    );

    html += movieHtml;
  }

  return html;
};

export { Movie };
