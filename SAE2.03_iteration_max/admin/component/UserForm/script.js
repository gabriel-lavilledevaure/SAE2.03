let templateFile = await fetch("./component/UserForm/template.html");
let template = await templateFile.text();

let UserForm = {};

UserForm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { UserForm };
