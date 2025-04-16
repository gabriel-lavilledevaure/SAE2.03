let templateFile = await fetch("./component/Moviecategorie/template.html");
let template = await templateFile.text();

let Moviecategorie = {};

Moviecategorie.format = function (categories) {
  let listHTML = "";
  for (let i = 0; i < categories.length; i++) {
    let cat = categories[i];
    listHTML += `<li class="categorie__tag" onclick="C.handlerCategorie('${cat.name}')">${cat.name}</li>`;
  }

  let html = template.replace("{{categories}}", listHTML);
  return html;
};

export { Moviecategorie };
