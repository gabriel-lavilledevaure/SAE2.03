let templateFile = await fetch("./component/UpdateUserForm/template.html");
let template = await templateFile.text();

let UpdateUserForm = {};

UpdateUserForm.format = function (profiles, handlerSelect, handlerUpdate) {
  let html = template;

  let options = "";
  for (let i = 0; i < profiles.length; i++) {
    const p = profiles[i];
    options += `<option value="${p.id}" data-name="${p.name}" data-avatar="${p.image}" data-age="${p.datenaissance}">${p.name}</option>`;
  }

  html = html.replace("{{options}}", options);
  html = html.replace("{{handlerSelect}}", handlerSelect);
  html = html.replace("{{handler}}", handlerUpdate);

  return html;
};

UpdateUserForm.init = function () {
  const select = document.getElementById("user-select");
  const name = document.getElementById("user-name");
  const image = document.getElementById("user-image");
  const dob = document.getElementById("user-dob");

  select.addEventListener("change", (event) => {
    const selectedOption = event.target.selectedOptions[0];
    if (selectedOption) {
      name.value = selectedOption.dataset.name || "";
      image.value = selectedOption.dataset.avatar || "";
      dob.value = selectedOption.dataset.age || "";
    }
  });
};

export { UpdateUserForm };
