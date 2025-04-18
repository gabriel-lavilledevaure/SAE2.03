# Justification du choix de la base de données

### Gabriel Laville-Devaure

## Looping

Category 0,n <-> Categoriser <-> 1,n Movie
Une catégorie peut appartenir au minimum à 0 film, et à n films au maximum.
Un film peut appartenir au minimum à 1 catégorie, et à n catégorie au maximum.

Movie 0,n <-> Valoir <-> 1,1 Notation
Un film peut valoir au minimum à 0 note, et à n note au maximum.
Une note peut appartenir au minimum à 1 film, et à 1 films au maximum.

Movie 0,n <-> Etre commenté <-> 1,1 Comment
Un film peut être commenté 0 fois au minimum et n fois au maximum.
Un commentaire peut appartenir à 1 film au minimum et 1 film au maximum.

Movie 0,n <-> Etre aimé <-> 1,1 Likes
Un film peut être aimé 0 fois au minimum et n fois au maximum.
Un Like peut appartenir au minimum à 1 film et au maximum à 1 film.

User 0,n <-> Commenter <-> 1,1 Comment
Un utilisateur peut avoir au minimum à 0 commentaire, et n commentaires au maximum.
Un commentaire peut appartenir au minimum à 1 utilisateur, et à 1 utilisateur au maximum.

User 0,n <-> Aimer <-> 1,1 Likes
Un utilisateur peut avoir au minimum 0 likes, et n likes au maximum.
Un like peut appartenir au minimum à 1 utilisateur, et à 1 utilisateur au maximum.

User 0,n <-> Noter <-> 1,1 Notation
Un utilisateur peut avoir au minimum 0 notes, et n notes au maximum.
Une note correspond à 1 utilisateur au minimum et 1 utilisateur au maximum.

## Itération 5

Pour la cinquième itération, il nous est demandé de gérer des utilisateurs. J'ai donc décidé de créer une nouvelle table nommée **`User`**. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente (`INT`).
- **`name`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'utilisateur.
- **`image`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'image (nom + extension).
- **`datenaissance`** : Un champ de type `DATE` pour enregistrer la date de naissance de l'utilisateur. Ce champ pourra être utilisé ultérieurement pour appliquer des restrictions d'âge.

Cette structure permet une gestion efficace et évolutive des utilisateurs dans notre base de données.

## Itération 9

Pour la neuvième itération, il nous est demandé de gérer des favoris. J'ai donc décidé de créer une nouvelle table nommée **`Likes`**. Je rajoute un **`s`** car **`LIKE`** est un mot réservé SQL. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente (`INT`).
- **`id_user`** : Un id clé étrangère qui est reliée à la table **`User`** (`INT`).
- **`id_movie`** : Un id clé étrangère qui est reliée à la table **`Movie`** (`INT`).

Cette structure permet une gestion efficace et évolutive des favoris de nos utilisateurs dans notre base de données.

## Itération 11

Pour la onzième itération, il nous est demandé de gérer les recommandations. J'ai donc décidé d'ajouter à ma table **`Movie`** un attribut **`reco`** qui aura pour type **`BOOL`** et qui prendra **`True`** si le film doit apparaître dans les recommandations, **`False** si le cas contraire.

## Itération 14

Pour la quatorzième itération, il nous est demandé de gérer un système de notation. J'ai donc décidé de créer une nouvelle table nommée **`Notation`**. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente (`INT`).
- **`id_user`** : Un id clé étrangère qui est reliée à la table **`User`** (`INT`).
- **`id_movie`** : Un id clé étrangère qui est reliée à la table **`Movie`** (`INT`).
- **`note`** : Un entier compris entre 0 et 5 (`INT`) qui permettra d'attribuer par la suite un nombre d'étoiles au film noté.

Cette structure permet une gestion efficace et évolutive du système de notation par nos utilisateurs dans notre base de données.

## Itération 15

Pour la quinzième itération, il nous est demandé de gérer un système de commentaire. J'ai donc décidé de créer une nouvelle table nommée **`Comment`**. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente (`INT`).
- **`id_user`** : Un id clé étrangère qui est reliée à la table **User** (`INT`).
- **`id_movie`** : Un id clé étrangère qui est reliée à la table **Movie** (`INT`).
- **`commentary`** : Un champ de type `TEXT`` qui permettra de stocker le commentaire de l'utilisateur en fonction du film.
- **`time_post`** : Un champ de type `DATETIME`` qui permettra de stocker la date et l'heure de publication du commentaire.

Cette structure permet une gestion efficace et évolutive du système de commentaire dans notre base de données.

## Itération 16

Pour la seizième itération, il nous est demandé de gérer les commentaires. J'ai donc décidé d'ajouter à ma table **`Comment`** un attribut **`status`** qui aura pour type **`BOOL`** et qui prendra **`True`** si le commentaire doit apparaître dans les détails, **`False** si le cas contraire.

## Itération 17

Pour la dix-septième itération, il nous est demandé d'afficher les films ajoutés il y a moins de 7 jours comme "New". J'ai donc décidé d'ajouter à ma table **`Movie`** un attribut **`date_ajout`** qui aura pour type **`DATE`** avec valeur par défaut **`CURRENT_TIME`** et qui stockera la date à laquelle le film est ajouté à la base de donnée.
