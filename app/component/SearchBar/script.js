let templateFile = await fetch("./component/SearchBar/template.html");
let template = await templateFile.text();

let SearchBar = {};

SearchBar.format = function () {
  return template;
};

export { SearchBar };
