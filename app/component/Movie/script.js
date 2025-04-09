let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};
Movie.format = function (movies, isLikesPage = false) {
  if (movies.length === 0) {
    return "<p>Il n'y a pas de films disponibles.</p>";
  }

  let html = "";
  movies.forEach((movie) => {
    let movieHtml = template;

    // Remplacement des champs dynamiques
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace(
      "{{handler}}",
      `C.handlerDetail(${movie.id}, this)`
    );

    const handlerFavoris = isLikesPage
      ? `C.handlerRemoveFavoris(${movie.id}, this)`
      : `C.handlerAddFavoris(${movie.id}, this)`;

    movieHtml = movieHtml.replace("{{handlerFavoris}}", handlerFavoris);

    if (isLikesPage) {
      movieHtml = movieHtml.replace(
        "{{deleteLike}}",
        `<button class="card__delete" onclick="event.stopPropagation(); C.handlerRemoveLike(${movie.id}, this)">❌</button>`
      );
    } else {
      movieHtml = movieHtml.replace("{{deleteLike}}", "");
    }

    html += movieHtml;
  });

  return html;
};

export { Movie };
