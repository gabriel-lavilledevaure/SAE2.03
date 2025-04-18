let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (
  hAbout,
  hProfile,
  profiles,
  handlerLikes,
  searchbar,
  categorieMenu
) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{handler}}", hProfile);

  let options = "";
  for (let i = 0; i < profiles.length; i++) {
    let p = profiles[i];
    options += `<option value="${p.name}" data-id="${p.id}" data-img="${p.image}" data-birthday="${p.datenaissance}">${p.name}</option>`;
  }

  let image = profiles[0]?.image || "";

  html = html.replace("{{options}}", options);
  html = html.replace("{{image}}", image);
  html = html.replace("{{handlerLikes}}", handlerLikes);
  html = html.replace("{{searchbar}}", searchbar);
  html = html.replace("{{categorieMenu}}", categorieMenu);

  return html;
};

export { NavBar };
