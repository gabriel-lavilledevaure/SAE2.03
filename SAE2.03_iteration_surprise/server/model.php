    <?php

    /**
     * Définition des constantes de connexion à la base de données.
     *
     * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
     * DBNAME : Nom de la base de données
     * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
     * DBPWD : Mot de passe pour se connecter à la base de données.
     */
    // Ces constantes sont utilisées pour établir une connexion à la base de données.
    define('HOST', 'localhost');
    define('DBNAME', 'lavilledevaur1');
    define('DBLOGIN', 'lavilledevaur1');
    define('DBPWD', 'lavilledevaur1');

    /**
     * Fonction pour récupérer tous les films de la base de données.
     *
     * @return array Un tableau d'objets contenant les informations des films
     */
    function getMovie()
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT id, name, image, reco, date_ajout FROM Movie';

        $answer = $cnx->query($sql);
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer tous les profils d'utilisateurs de la base de données.
     *
     * @return array Un tableau d'objets contenant les informations des utilisateurs
     */
    function getProfiles()
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT id, name, image, datenaissance FROM User';

        $answer = $cnx->query($sql);
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer tous les commentaires de la base de données.
     *
     * @return array Un tableau d'objets contenant les informations des utilisateurs
     */
    function getComment($id_movie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'SELECT Comment.id_user, Comment.id_movie, Comment.commentary, Comment.time_post,
        User.name AS user_name, User.image AS user_image
 FROM Comment 
 LEFT JOIN User ON Comment.id_user = User.id 
 WHERE Comment.id_movie = :id_movie
   AND Comment.status = 1
 ORDER BY Comment.time_post DESC';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour récupérer les informations d'un film en fonction de son id.
     *
     * @param int $id L'identifiant du film
     * @return array Un tableau d'objets contenant les informations du film
     */
    function getMovieinfos($id)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT Movie.id, Movie.name, image, description, director, year, length, Category.name AS category_name, min_age, trailer 
                FROM Movie 
                INNER JOIN Category ON Movie.id_category = Category.id 
                WHERE Movie.id = :id
    ';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer les films recommandés en fonction de l'âge
     *
     * @param int $age L'âge de l'utilisateur
     * @return array Un tableau d'objets contenant les films recommandés
     */
    function getMovieReco($age)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'SELECT Movie.id, Movie.name, Movie.image, Movie.year, Movie.min_age, Movie.description,Movie.trailer, Category.name AS category_name
                FROM Movie
                INNER JOIN Category ON Movie.id_category = Category.id
                WHERE Movie.reco = 1 AND Movie.min_age <= :age';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer toutes les catégories de films
     *
     * @return array Un tableau d'objets contenant les noms des catégories
     */
    function getAllCategories()
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT name FROM Category';
        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer les films en fonction de la catégorie
     *
     * @param string $categorie La catégorie de film
     * @return array Un tableau d'objets contenant les films de cette catégorie
     */
    function getMoviecategorie($categorie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT Movie.id, Movie.name, image 
                FROM Movie 
                INNER JOIN Category ON Movie.id_category = Category.id 
                WHERE LOWER(Category.name) = LOWER(:categorie)
    ';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer les films en fonction de l'âge
     *
     * @param int $age L'âge de l'utilisateur
     * @return array Un tableau d'objets contenant les films accessibles à cet âge
     */
    function getMoviesByAge($age)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT id, name, image, min_age FROM Movie WHERE min_age <= :age';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Fonction pour récupérer les films aimés par un utilisateur
     *
     * @param int $id_user L'identifiant de l'utilisateur
     * @return array Un tableau d'objets contenant les films aimés par cet utilisateur
     */
    function getLikesUserMovie($id_user)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT id_user, id_movie FROM Likes WHERE id_user = :id_user';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour ajouter un film à la base de données
     *
     * @param string $titre Le titre du film
     * @param string $real Le réalisateur du film
     * @param int $annee L'année de sortie du film
     * @param int $duree La durée du film en minutes
     * @param string $des La description du film
     * @param string $cat La catégorie du film
     * @param string $img L'image du film
     * @param string $url L'URL de la bande-annonce du film
     * @param int $age L'âge minimum recommandé pour le film
     * @return int Le nombre de lignes affectées par l'insertion
     */
    function addMovie($titre, $real, $annee, $duree, $des, $cat, $img, $url, $age)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
                VALUES (:titre, :realisateur, :annee, :duree, :desc, :categorie, :image, :url, :age)';

        $stmt = $cnx->prepare($sql);

        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':realisateur', $real);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':desc', $des);
        $stmt->bindParam(':categorie', $cat);
        $stmt->bindParam(':image', $img);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':age', $age);

        $stmt->execute();
        $res = $stmt->rowCount();
        return $res;
    }

    /**
     * Fonction pour ajouter un utilisateur à la base de données
     *
     * @param string $name Le nom de l'utilisateur
     * @param string $image L'image de l'utilisateur
     * @param string $datenaissance La date de naissance de l'utilisateur
     * @return int Le nombre de lignes affectées par l'insertion
     */
    function addUser($name, $image, $datenaissance)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'INSERT INTO User (name, image, datenaissance) 
                VALUES (:name, :image, :datenaissance)';

        $stmt = $cnx->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':datenaissance', $datenaissance);

        $stmt->execute();
        $res = $stmt->rowCount();
        return $res;
    }

    /**
     * Fonction pour ajouter un commentaire à la base de données
     *
     * @param string $id_user l'id de l'utilisateur
     * @param string $id_movie l'id du film
     * @param string $commentary le commentaire
     */
    function addCommentary($id_user, $id_movie, $commentary)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'INSERT INTO Comment (id_user, id_movie, commentary, time_post) 
        VALUES (:id_user, :id_movie, :commentary, NOW())';

        $stmt = $cnx->prepare($sql);

        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_movie', $id_movie);
        $stmt->bindParam(':commentary', $commentary);

        $stmt->execute();
        $res = $stmt->rowCount();
        return $res;
    }

    /**
     * Fonction pour ajouter un like à la base de données
     *
     * @param int $user L'identifiant de l'utilisateur
     * @param int $movie L'identifiant du film
     * @return int Le nombre de lignes affectées par l'insertion
     */
    function addLikes($user, $movie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'INSERT INTO Likes (id_user, id_movie) 
                VALUES (:id_user, :id_movie)';

        $stmt = $cnx->prepare($sql);

        $stmt->bindParam(':id_user', $user);
        $stmt->bindParam(':id_movie', $movie);

        $stmt->execute();
        $res = $stmt->rowCount();
        return $res;
    }

    /**
     * Fonction pour récupérer les films en fonction de l'âge et de la catégorie
     *
     * @param int $age L'âge de l'utilisateur
     * @param string $categorie La catégorie de film
     * @return array Un tableau d'objets contenant les films accessibles à cet âge et dans cette catégorie
     */
    function getMoviesAgeCategory($age, $categorie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT Movie.id, Movie.name, Movie.image
                FROM Movie
                INNER JOIN Category ON Movie.id_category = Category.id
                WHERE Movie.min_age <= :age AND LOWER(Category.name) = LOWER(:categorie)';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour mettre à jour les informations d'un utilisateur
     *
     * @param int $id L'identifiant de l'utilisateur
     * @param string $name Le nom de l'utilisateur
     * @param string $image L'image de l'utilisateur
     * @param string $datenaissance La date de naissance de l'utilisateur
     * @return int Le nombre de lignes affectées par la mise à jour
     */
    function updateUser($id, $name, $image, $datenaissance)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);

        $sql = 'UPDATE User SET name = :name, image = :image, datenaissance = :datenaissance WHERE id = :id';

        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':datenaissance', $datenaissance);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Fonction pour vérifier si un utilisateur existe dans la base de données
     *
     * @param string $name Le nom de l'utilisateur
     * @return bool True si l'utilisateur existe, sinon false
     */
    function checkUser($name)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT COUNT(*) FROM User WHERE name = :name';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    /**
     * Fonction pour supprimer un like de la base de données
     *
     * @param int $user L'identifiant de l'utilisateur
     * @param int $movie L'identifiant du film
     * @return int Le nombre de lignes affectées par la suppression
     */
    function removeLikes($user, $movie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'DELETE FROM Likes WHERE id_user = :id_user AND id_movie = :id_movie';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_user', $user);
        $stmt->bindParam(':id_movie', $movie);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Fonction pour rechercher des films en fonction d'un titre
     *
     * @param string $titre Le titre du film
     * @return array Un tableau d'objets contenant les films correspondants
     */
    function searchMoviesTitre($titre)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT Movie.id, Movie.name, Movie.image, Movie.year, Movie.min_age, Movie.description, Movie.reco, Category.name AS category_name
                FROM Movie
                INNER JOIN Category ON Movie.id_category = Category.id
                WHERE Movie.name LIKE :titre OR Category.name LIKE :titre OR year LIKE :titre';

        $stmt = $cnx->prepare($sql);
        $liketitre = '%' . $titre . '%';
        $stmt->bindParam(':titre', $liketitre);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour mettre à jour le statut de recommandation d'un film
     *
     * @param int $id L'identifiant du film
     * @param int $reco Le statut de recommandation (1 ou 0)
     * @return bool True si la mise à jour a réussi, sinon false
     */
    function updateMovieRecoStatus($id, $reco)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'UPDATE Movie SET reco = :reco WHERE id = :id';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':reco', $reco, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    /**
     * Fonction pour ajouter une note à un film
     *
     * @param int $id_user L'identifiant de l'utilisateur
     * @param int $id_movie L'identifiant du film
     * @param int $note La note donnée par l'utilisateur
     * @return bool True si l'ajout a réussi, sinon false
     */
    function addNote($id_user, $id_movie, $note)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'INSERT INTO Notation (id_user, id_movie, note) VALUES (:id_user, :id_movie, :note)';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    /**
     * Fonction pour récupérer la moyenne des notes d'un film
     *
     * @param int $id_movie L'identifiant du film
     * @return float La moyenne des notes
     */
    function getMoyenneNote($id_movie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT ROUND(AVG(note), 1) as moyenne FROM Notation WHERE id_movie = :id_movie';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_movie', $id_movie);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour vérifier si un utilisateur a déjà noté un film
     *
     * @param int $id_user L'identifiant de l'utilisateur
     * @param int $id_movie L'identifiant du film
     * @return bool True si l'utilisateur a déjà noté le film, sinon false
     */
    function checkUserNote($id_user, $id_movie)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT COUNT(*) FROM Notation WHERE id_user = :id_user AND id_movie = :id_movie';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_movie', $id_movie);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    /**
     * Fonction pour récupérer les commentaires en attente d'approbation
     *
     * @return array Un tableau d'objets contenant les commentaires en attente
     */
    function getCommentAttente()
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'SELECT Comment.id, Comment.commentary, Comment.time_post, Comment.status,
                   User.name AS user_name, User.image AS user_image
            FROM Comment
            LEFT JOIN User ON Comment.id_user = User.id
            WHERE Comment.status = 0
            ORDER BY Comment.time_post DESC';

        $stmt = $cnx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fonction pour approuver un commentaire
     *
     * @param int $id L'identifiant du commentaire
     * @return bool True si l'approbation a réussi, sinon false
     */
    function approveComment($id)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'UPDATE Comment SET status = 1 WHERE id = :id';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Fonction pour supprimer un commentaire
     *
     * @param int $id L'identifiant du commentaire
     * @return bool True si la suppression a réussi, sinon false
     */
    function removeComment($id)
    {
        $cnx = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBLOGIN, DBPWD);
        $sql = 'DELETE FROM Comment WHERE id = :id';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
