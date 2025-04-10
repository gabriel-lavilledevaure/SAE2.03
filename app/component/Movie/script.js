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

    // Remplacements principaux
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace("{{id}}", movie.id); // deuxième remplacement pour l'autre bouton
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
