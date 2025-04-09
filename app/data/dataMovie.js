// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03";

let DataMovie = {};

// DataMovie.requestMovies = async function () {
//   // Récupération des films
//   let answer = await fetch(HOST_URL + "server/script.php?todo=getMovie");
//   let movies = await answer.json();
//   return movies;
// };

DataMovie.requestMovies = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getMovie");
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMoviedetails = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getMovieinfos&id=" + id
  );
  let movie = await answer.json();
  return movie;
};

DataMovie.requestCategories = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getCategories");
  let categories = await answer.json();
  return categories;
};

DataMovie.requestMoviecategorie = async function (categorie) {
  let answer = await fetch(
    HOST_URL +
      "/server/script.php?todo=getMoviecategorie&categorie=" +
      categorie
  );
  let movie = await answer.json();
  return movie;
};

DataMovie.requestMoviesByAge = async function (age) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getMoviesByAge&age=" + age
  );
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMoviesReco = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getMovieReco");
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMoviesAgeCategory = async function (age, categorie) {
  let answer = await fetch(
    HOST_URL +
      "/server/script.php?todo=getMoviesAgeCategory&age=" +
      age +
      "&categorie=" +
      categorie
  );
  let movies = await answer.json();
  return movies;
};

// On exporte la fonction DataMovie.requestMovies
export { DataMovie };
