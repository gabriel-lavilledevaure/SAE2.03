// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL ="https://mmi.unilim.fr/~lavilledevaur1/SAE/SAE2.03/";

let DataMovie = {};

DataMovie.requestMovies = function() {
    // Récupération des films
    let answer = await fetch(HOST_URL + "server/script.php?request=movies");
    
    if (answer.ok) {
        // On récupère le contenu de la réponse
        let data = await answer.json();
        return data;
    }
    else {
        // On affiche un message d'erreur dans la console
        console.log("Erreur lors de la récupération des films");
        // On retourne null
        return null;
    }

}   

// On exporte la fonction DataMovie.requestMovies
export { DataMovie };