let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hProfile, profiles, handlerLikes) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{handler}}", hProfile);

  let options = profiles
    .map(
      (p) =>
        `<option value="${p.name}" data-img="${p.image}" data-dob="${p.datenaissance}">${p.name}</option>`
    )
    .join("");

  let image = profiles[0]?.image || "";

  html = html.replace("{{options}}", options);
  html = html.replace("{{image}}", image);
  html = html.replace("{{handlerLikes}}", handlerLikes);

  return html;
};

export { NavBar };
