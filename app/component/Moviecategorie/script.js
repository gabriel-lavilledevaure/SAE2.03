let templateFile = await fetch("./component/Moviecategorie/template.html");
let template = await templateFile.text();

let Moviecategorie = {};

Moviecategorie.format = function () {
  return template;
};

export { Moviecategorie };
