# Justification du choix de la base de données

## Itération 5

Pour la cinquième itération, il nous est demandé de gérer des utilisateurs. J'ai donc décidé de créer une nouvelle table nommée **`User`**. Cette table comporte les attributs suivants :

- **`id`** : Une clé unique qui s'auto-incrémente.
- **`name`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'utilisateur.
- **`image`** : Un champ de type `VARCHAR(150)` pour stocker le nom de l'image (nom + extension).
- **`datenaissance`** : Un champ de type `DATE` pour enregistrer la date de naissance de l'utilisateur. Ce champ pourra être utilisé ultérieurement pour appliquer des restrictions d'âge.

Cette structure permet une gestion efficace et évolutive des utilisateurs dans notre base de données.
