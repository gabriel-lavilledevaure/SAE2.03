let templateFile = await fetch("./component/NewFilmForm/template.html");
let template = await templateFile.text();

let NewFilmForm = {};

NewFilmForm.format = function () {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { NewFilmForm };
