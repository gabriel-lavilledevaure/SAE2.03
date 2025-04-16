let templateFile = await fetch("./component/SearchBar/template.html");
let template = await templateFile.text();

let SearchBar = {};

SearchBar.format = function () {
  return template;
};

SearchBar.resultat = function (films) {
  const container = document.getElementById("searchbar-results");
  container.innerHTML = "";
  console.log("reco après update", films);

  if (!films || films.length === 0) {
    container.innerHTML =
      '<li class="searchbar__results__item">Aucun film ne correspond à votre recherche.</li>';
    return;
  }

  for (let i = 0; i < films.length; i++) {
    const film = films[i];
    const recoActuel = film.reco == 1;
    const recoLabel = recoActuel ? "✅ Mis en avant" : "❌ Non mis en avant";
    const buttonLabel = recoActuel ? "Retirer" : "Mettre en avant";
    const nextStatus = recoActuel ? "0" : "1";

    const li = document.createElement("li");
    li.className = "searchbar__results__item";
    li.innerHTML = `
      <div class="result-item">
        <strong>${film.name}</strong> (${film.year}) - ${film.category_name}<br/>
        <span>${recoLabel}</span><br/>
        <button onclick="C.handlerToggleReco(${film.id}, '${film.reco}')">
          ${buttonLabel}
        </button>
      </div>
    `;
    container.appendChild(li);
  }
};

export { SearchBar };
