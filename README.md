# MonPremierBlog

Le projet est de créer un blog en PHP. Il est dans le context de la formation "Développeur PHP/Symfony".
Le site propose un menu avec les sections suivantes : Accueil, À propos, CV, Blog et Contact.

## Fonctionnalités

Le blog offre les fonctionnalités suivantes :

- Inscription, connectez, déconnectez

Sur la page d'accueil:
- Affichage du dernier article de blog.
- Présentation d'une biographie de l'auteur sur la partie "À propos".
- Formulaire de contact permettant aux visiteurs de m'envoyer des messages.

Sur la page CV
- Affichage du CV de l'auteur.

Sur la page Blog
- Liste des articles de blog avec la possibilité de les lire en entier.
- Système de commentaires qui permet aux utilisateurs connectés de laisser des commentaires sur les articles.

Sur la page Admin
- Articles
  - Lecture d'un article
  - Ajout d'un nouvel article de blog.
  - Modification des articles existants.
  - Suppression des articles existants.
- Commentaires
  - Validation des commentaires avant leur affichage public.
- Utilisateurs
  - Modification du rôle des utilisateurs.
  - Suppression de comptes.

Des liens vers les réseaux sociaux

## Installation
Pour commencer avec ce projet PHP, suivez les étapes ci-dessous
1. Clonez le dépôt
   `git clone https://github.com/ZitaNguyen/MonPremierBlog.git`
2. Accédez au répertoire du projet
   `cd <nom du répertoire>`
3. Installez les dépendances requises pour le projet
   `composer install`
4. Configurez de la base de données
   Installez MAMP ou XAMPP si besoin
   Importer le fichier `myfirstblog.sql` dans la base de données
   Changez des valeurs dans le fichier `src/Library/Config.php` pour adapter avec vos configurations locaux.
5. Configurez le serveur afin d'envoyer un email depuis le formulaire du contact
   Adaptez des configurations de votre serveur dans le fichier `src/Controllers/HomeController.php`
6. Démarrez le serveur de développement
   `php -S localhost:8000`

## Licence

Ce projet est sous licence Apache License 2.0.