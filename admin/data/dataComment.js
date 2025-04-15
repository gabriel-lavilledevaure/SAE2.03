let HOST_URL = "..";

let DataComment = {};

DataComment.getComments = async function () {
  let res = await fetch(`${HOST_URL}/server/script.php?todo=getCommentAttente`);
  return await res.json();
};

DataComment.approveComment = async function (id) {
  let fd = new FormData();
  fd.append("id", id);
  let res = await fetch(`${HOST_URL}/server/script.php?todo=approveComment`, {
    method: "POST",
    body: fd,
  });
  return await res.json();
};

DataComment.removeComment = async function (id) {
  let fd = new FormData();
  fd.append("id", id);
  let res = await fetch(`${HOST_URL}/server/script.php?todo=removeComment`, {
    method: "POST",
    body: fd,
  });
  return await res.json();
};

export { DataComment };
