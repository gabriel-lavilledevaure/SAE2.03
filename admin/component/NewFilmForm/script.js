let templateFile = await fetch("./component/NewFilmForm/template.html");
let template = await templateFile.text();

let NewFilmForm = {};

NewFilmForm.format = function () {
  let html = template;
  return html;
};

export { NewFilmForm };
