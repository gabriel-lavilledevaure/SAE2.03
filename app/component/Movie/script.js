let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};
Movie.format = function (movies) {
  // préventio s'il n'y a pas de films
  if (movies.length === 0) {
    return "<p>Il n'y a pas de films disponibles.</p>";
  }
  let html = "";
  movies.forEach((movie) => {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace(
      "{{handlerFavoris}}",
      `C.handlerFavoris(${movie.id}, this)`
    );

    movieHtml = movieHtml.replace(
      "{{handler}}",
      `C.handlerDetail(${movie.id}, this)`
    );

    html += movieHtml;
  });

  return html;
};

export { Movie };
