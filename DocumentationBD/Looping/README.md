# Justification du choix de la base de données

## Itération 5

Pour la cinquième itération, il nous est demandé de gérer des utilisateurs. J'ai donc décidé de créer une nouvelle table nommée **`User`**. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente.
- **`name`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'utilisateur.
- **`image`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'image (nom + extension).
- **`datenaissance`** : Un champ de type `DATE` pour enregistrer la date de naissance de l'utilisateur. Ce champ pourra être utilisé ultérieurement pour appliquer des restrictions d'âge.

Cette structure permet une gestion efficace et évolutive des utilisateurs dans notre base de données.

## Itération 9

Pour la neuvième itération, il nous est demandé de gérer des favoris. J'ai donc décidé de créer une nouvelle table nommée **`Likes`**.Je rajoute un **`s`** car **`LIKE`** est un mot réservé SQL. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente.
- **`id_user`** : Un id clé étrangère qui est reliée à la table **`User`**.
- **`id_movie`** : un id clé étrangère qui est reliée à la table **`Movie`**.

Cette structure permet une gestion efficace et évolutive des favoris de nos utilisateurs dans notre base de données.
