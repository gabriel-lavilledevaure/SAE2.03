let templateFile = await fetch("./component/SearchBar/template.html");
let template = await templateFile.text();

let SearchBar = {};

SearchBar.format = function () {
  return template;
};

SearchBar.resultat = function (films) {
  const container = document.getElementById("searchbar-results");
  container.innerHTML = "";

  if (!films || films.length === 0) {
    container.innerHTML =
      '<li class="searchbar__results__item">Aucun film ne correspond à votre recherche.</li>';
    return;
  }

  films.forEach((film) => {
    const recoActuel = film.reco === "1";
    const recoLabel = recoActuel ? "✅ Mis en avant" : "❌ Non mis en avant";
    const buttonLabel = recoActuel ? "Retirer" : "Mettre en avant";
    const nextStatus = recoActuel ? "1" : "0"; // valeur actuelle à envoyer

    const li = document.createElement("li");
    li.className = "searchbar__results__item";
    li.innerHTML = `
      <div class="result__item">
        <strong>${film.name}</strong> (${film.year}) - ${film.category_name}<br/>
        <span>${recoLabel}</span><br/>
        <button onclick="C.handlerToggleReco(${film.id}, '${nextStatus}')">
          ${buttonLabel}
        </button>
      </div>
    `;
    container.appendChild(li);
  });
};

export { SearchBar };
