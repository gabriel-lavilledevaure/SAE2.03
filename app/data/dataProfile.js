let HOST_URL = "..";

let DataProfile = {};

DataProfile.requestProfiles = async function () {
  let res = await fetch(HOST_URL + "/server/script.php?todo=getProfiles");
  return await res.json();
};

DataProfile.requestUserLikes = async function (id_user) {
  let res = await fetch(
    `${HOST_URL}/server/script.php?todo=getLikesUserMovie&id_user=${id_user}`
  );
  return await res.json();
};

DataProfile.removeLike = async function (id_user, id_movie) {
  const fd = new FormData();
  fd.append("id_user", id_user);
  fd.append("id_movie", id_movie);

  const res = await fetch(`${HOST_URL}/server/script.php?todo=removeLikes`, {
    method: "POST",
    body: fd,
  });

  return await res.json();
};

DataProfile.addLike = async function (id_user, id_movie) {
  const fd = new FormData();
  fd.append("id_user", id_user);
  fd.append("id_movie", id_movie);

  const res = await fetch(`${HOST_URL}/server/script.php?todo=addLikes`, {
    method: "POST",
    body: fd,
  });

  return await res.json();
};

export { DataProfile };
