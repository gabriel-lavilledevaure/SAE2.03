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

// On exporte la fonction DataMovie.requestMovies
export { DataMovie };
