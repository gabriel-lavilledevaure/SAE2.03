// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03";

let DataProfile = {};

// DataProfile.requestMovies = async function () {
//   // Récupération des films
//   let answer = await fetch(HOST_URL + "server/script.php?todo=getMovie");
//   let movies = await answer.json();
//   return movies;
// };

DataProfile.requestProfiles = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getProfiles");
  let profiles = await answer.json();
  return profiles;
};

DataProfile.requestLikesForUser = async function (id_user) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getLikesUserMovie&id_user=" + id_user
  );
  let likes = await answer.json();
  return likes;
};

// DataProfile.requestMoviedetails = async function (id) {
//   let answer = await fetch(
//     HOST_URL + "/server/script.php?todo=getMovieinfos&id=" + id
//   );
//   let movie = await answer.json();
//   return movie;
// };

// DataProfile.requestCategories = async function () {
//   let answer = await fetch(HOST_URL + "/server/script.php?todo=getCategories");
//   let categories = await answer.json();
//   return categories;
// };

// DataProfile.requestMoviecategorie = async function (categorie) {
//   let answer = await fetch(
//     HOST_URL +
//       "/server/script.php?todo=getMoviecategorie&categorie=" +
//       categorie
//   );
//   let movie = await answer.json();
//   return movie;
// };

// On exporte la fonction DataProfile.requestMovies
export { DataProfile };
