let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movie) {
  let html = template;
  html = html.replace("{{titre}}", movie.titre);
  html = html.replace("{{image}}", movie.image);
  return html;
};

export { Movie };
