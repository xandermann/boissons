HUBLAU Alexandre
MATUCHET Louis

# Projet Boisson Programmation web S5, 2019-2020

[https://boissons.alexandre-hublau.com](https://boissons.alexandre-hublau.com)

# Avant de lancer le projet

Initialiser la base de données:
Merci de creer un fichier de configuration dans **src/Config/config.ini**.
Un exemple de configuration est fourni dans **src/Config/config-exemple.ini**.

Nous n'utilisons pas de framework pour ce projet.

## L'arborescence se fait de cette manière :
	- dossier "src" avec toutes les sources php.
		- dossier "config" avec les configurations (informations concernant la BDD par exemple)
		- dossier "modeles" qui contient les informations de l'applications
		- dossier "vues" qui contient le code HTML
		- dossier "controlleurs" qui contient la logique de notre application
	- dossier "public" avec l'"index.php", les fichiers css, javascript ainsi que toutes les images

## Choix

Nous n'avons finalement pas utilisé SlimPHP.

Nous avons préféré que l'utilisateur clique plusieurs fois pour pouvoir voir des boissons car dans le cas ou le fichier de données est lourd et que l'utilisateur a une mauvaise connection le temps de chargement pourrait être long.

L'existence de public évite que l'utilisateur ne puisse pas voyager dans toute l'arborescence de fichiers. Sa vision sera limitée à ce seul document ce qui permet entre autre que s'il y a des données plus ou moins sensibles dans un autre dossier il ne pourra y accéder.

Pas de base de données car pas obligatoire et surtout évitable pour les boissons.

On a utiliser un autoloader (une fonction du psr-4) pour ne pas à faire 50 *require()* et *include()* dans chaque classe.
La fonction est utilisée ici: [https://www.php-fig.org/psr/psr-4/examples/](https://www.php-fig.org/psr/psr-4/examples/)

Les mots de passe sont chiffrés avec le mode **bcrypt**.

Lorsque les utilisateurs choisissent des recettes:
* Si l'utilisateur n'est pas connecté, alors les recettes sont sauvegardées dans la session
	* Si l'utilisateur se connecte, alors il récupère seulement les données qu'il avait ajouté à la base de données
	* Si l'utilisateur se déconnecte, alors les recettes sont effacées de sa session (mais pas de son compte !)
	* Si l'utilisateur connecté supprime les recettes, alors elles sont supprimées de son compte et sa session
	* Si l'utilisateur non connecté supprime les recettes, alors elles sont supprimées de sa session

Nous avons ajouté les messages flash pour prévenir l'utilisateur s'il a fait une action.
(Ce sont des messages qui apparaissent que pendant le chargement d'une seule page)
