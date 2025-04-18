let templateFile = await fetch("./component/Moviecategorie/template.html");
let template = await templateFile.text();

let Moviecategorie = {};

Moviecategorie.format = function (categories) {
  let listHTML = "";
  for (let i = 0; i < categories.length; i++) {
    let cat = categories[i];
    listHTML += `<li class="navbar__dropdown-item" onclick="C.handlerCategorie('${cat.name}')">${cat.name}</li>`;
  }

  return listHTML;
};

export { Moviecategorie };
