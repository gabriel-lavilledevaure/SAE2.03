# Justification du choix de la base de données

### Gabriel Laville-Devaure

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

Cette structure permet une gestion efficace et évolutive du système de commentaire dans notre base de données.
