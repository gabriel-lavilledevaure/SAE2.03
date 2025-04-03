let templateFile = await fetch("./component/NewFilmForm/template.html");
let template = await templateFile.text();

let NewFilmForm = {};

NewFilmForm.format = function () {
  let html = template;

  // html = html.replaceAll("{{handler}}", handler);
  // html = html.replace("{{movie}}", movie);
  return html;
};

export { NewFilmForm };
