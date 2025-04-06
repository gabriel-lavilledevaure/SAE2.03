let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, profiles) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);

  let options = profiles
    .map(
      (p) =>
        `<option value="${p.name}" data-img="${p.image}">${p.name}</option>`
    )
    .join("");

  let image = profiles[0]?.image || "";

  html = html.replace("{{options}}", options);
  html = html.replace("{{image}}", image);

  return html;
};

export { NavBar };
