let templateFile = await fetch("./component/Moviedetails/template.html");
let template = await templateFile.text();

let Moviedetails = {};

Moviedetails.format = function (movie, noteMoyenne = null, dejaNote = false) {
  let movieHtml = template;

  movieHtml = movieHtml.replace("{{titre}}", movie.name);
  movieHtml = movieHtml.replace("{{image}}", movie.image);
  movieHtml = movieHtml.replace("{{desc}}", movie.description);
  movieHtml = movieHtml.replace("{{realisateur}}", movie.director);
  movieHtml = movieHtml.replace("{{annee}}", movie.year);
  movieHtml = movieHtml.replace("{{duree}}", movie.length);
  movieHtml = movieHtml.replace("{{categorie}}", movie.category_name);
  movieHtml = movieHtml.replace("{{age}}", movie.min_age);
  movieHtml = movieHtml.replace("{{url}}", movie.trailer);
  movieHtml = movieHtml.replace("{{moyenne}}", noteMoyenne ?? "Aucune note");

  movieHtml += `
    <div class="notation">
      ${
        !dejaNote
          ? `
        <label for="note-select">Attribuez une note :</label>
        <select id="note-select">
          <option value="">--Choisissez--</option>
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button onclick="C.handlerSubmitNote(${movie.id})">Valider</button>
      `
          : `<p class="already-noted">Vous avez déjà noté ce film.</p>`
      }
    </div>
  `;

  return movieHtml;
};

export { Moviedetails };
