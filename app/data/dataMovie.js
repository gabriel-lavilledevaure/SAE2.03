// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";

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

DataMovie.requestMoviesReco = async function (age) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getMovieReco&age=" + age
  );
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

DataMovie.requestSearchMovies = async function (valeur) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=searchMovies&titre=" + valeur
  );
  let movies = await answer.json();
  return movies;
};

// Ajouter une note
DataMovie.addNote = async function (id_user, id_movie, note) {
  const fd = new FormData();
  fd.append("id_user", id_user);
  fd.append("id_movie", id_movie);
  fd.append("note", note);

  console.log("id_user", id_user); // debug
  console.log("id_movie", id_movie); // debug
  console.log("note", note); // debug

  const res = await fetch(`${HOST_URL}/server/script.php?todo=addNote`, {
    method: "POST",
    body: fd,
  });

  if (!res.ok) {
    return { error: true, message: "Erreur serveur : code " + res.status };
  }

  const data = await res.json();
  return data;
};

// Récupérer la moyenne des notes d’un film
DataMovie.getMoyenneNote = async function (id_movie) {
  const res = await fetch(
    `${HOST_URL}/server/script.php?todo=getMoyenneNote&id_movie=${id_movie}`
  );
  return await res.json();
};

// Vérifier si l'utilisateur a déjà noté ce film
DataMovie.checkUserNote = async function (id_user, id_movie) {
  const res = await fetch(
    `${HOST_URL}/server/script.php?todo=checkUserNote&id_user=${id_user}&id_movie=${id_movie}`
  );
  return await res.json(); // retourne { dejaNote: true }
};

// On exporte la fonction DataMovie.requestMovies
export { DataMovie };
