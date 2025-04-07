import { DataProfile } from "../../data/dataProfile.js";

let templateFile = await fetch("./component/UserForm/template.html");
let template = await templateFile.text();

let UserForm = {};

UserForm.format = async function (handlerAdd, handlerUpdate) {
  let html = template;

  // Récupération des profils depuis le serveur
  let profiles = await DataProfile.requestProfiles();

  // Construction des options <option>
  let options = profiles
    .map(
      (p) =>
        `<option value="${p.name}" data-name="${p.name}" data-img="${p.image}" data-dob="${p.datenaissance}">${p.name}</option>`
    )
    .join("");

  // Remplacement dans le template
  html = html.replace("{{options}}", options);
  html = html.replace("{{handlerAdd}}", handlerAdd);
  html = html.replace("{{handlerUpdate}}", handlerUpdate);

  return html;
};

export { UserForm };
