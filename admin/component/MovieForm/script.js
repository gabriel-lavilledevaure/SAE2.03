let templateFile = await fetch("./component/MovieForm/template.html");
let template = await templateFile.text();

let NewFilmForm = {};

NewFilmForm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { NewFilmForm };
