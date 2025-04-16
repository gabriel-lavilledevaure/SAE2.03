// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";

let DataMovie = {};

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

DataMovie.addNote = async function (id_user, id_movie, note) {
  const fd = new FormData();
  fd.append("id_user", id_user);
  fd.append("id_movie", id_movie);
  fd.append("note", note);

  // console.log("id_user", id_user); // debug
  // console.log("id_movie", id_movie); // debug
  // console.log("note", note); // debug

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

DataMovie.getMoyenneNote = async function (id_movie) {
  const res = await fetch(
    `${HOST_URL}/server/script.php?todo=getMoyenneNote&id_movie=${id_movie}`
  );
  return await res.json();
};

DataMovie.checkUserNote = async function (id_user, id_movie) {
  const res = await fetch(
    `${HOST_URL}/server/script.php?todo=checkUserNote&id_user=${id_user}&id_movie=${id_movie}`
  );
  return await res.json();
};

DataMovie.getCommentsMovie = async function (id_movie) {
  id_movie = parseInt(id_movie);
  const res = await fetch(
    `${HOST_URL}/server/script.php?todo=getComment&id_movie=${id_movie}`
  );
  const data = await res.json();
  console.log("Commentaires récupérés :", data);
  return data;
};

DataMovie.addComment = async function (id_user, id_movie, commentary) {
  const fd = new FormData();
  fd.append("id_user", id_user);
  fd.append("id_movie", id_movie);
  fd.append("commentary", commentary);

  const res = await fetch(`${HOST_URL}/server/script.php?todo=addComment`, {
    method: "POST",
    body: fd,
  });

  return await res.json();
};

export { DataMovie };
