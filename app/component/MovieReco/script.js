let templateFile = await fetch("./component/MovieReco/template.html");
let template = await templateFile.text();

let MovieReco = {};

MovieReco.format = function (movies) {
  if (!movies.length) return "";

  let cards = "";
  for (let index = 0; index < movies.length; index++) {
    const movie = movies[index];
    const image = movie.image ?? "placeholder.jpg";
    const name = movie.name ?? "Sans titre";
    const age = movie.min_age ?? "N.C";
    const year = movie.year ?? "????";
    const category = movie.category_name ?? "Inconnu";
    const description = movie.description ?? "Aucune description disponible.";

    cards += `
      <div class="reco__card" onclick="C.handlerDetail(${
        movie.id
      })" style="--i:${index + 1}">
        <div class="reco__img-wrapper">
          <img class="reco__image" src="https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03/server/images/${image}" alt="${name}" />
          <div class="reco__overlay">
            <h3 class="reco__name">${name}</h3>
            <div class="reco__meta">
              <span class="reco__age">${age}+</span>
              <span class="reco__year">${year}</span>
              <span class="reco__category">${category}</span>
            </div>
          </div>
        </div>
        <div class="reco__description">
          ${description}
        </div>
      </div>`;
  }

  return template.replace("{{cards}}", cards);
};

export { MovieReco };
