let templateFile = await fetch("./component/Comment/template.html");
let template = await templateFile.text();

let Comment = {};

Comment.format = function (data, handlerApprove, handlerDelete) {
  if (!data || data.length === 0) {
    return template.replace(
      "{{content}}",
      `<p class="comment__empty">Aucun commentaire à modérer pour le moment.</p>`
    );
  }

  let html = `<div class="comment__container">`;

  for (let i = 0; i < data.length; i++) {
    const c = data[i];
    const date = new Date(c.time_post);
    const formattedDate = `${date.getDate()}/${
      date.getMonth() + 1
    }/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
    html += `
      <div class="comment__card">
        <p class="comment__text">${c.commentary}</p>
        <p class="comment__author">${c.user_name} — ${formattedDate}</p>
        <p class="comment__status">${
          c.status == 0 ? "🕒 En attente" : "✅ Approuvé"
        }</p>
        <button onclick="${handlerApprove}(${c.id})">✅ Approuver</button>
        <button onclick="${handlerDelete}(${c.id})">❌ Supprimer</button>
      </div>`;
  }

  html += `</div>`;

  return template.replace("{{content}}", html);
};

export { Comment };
