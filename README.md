HUBLAU Alexandre
MATUCHET Louis

# TODO
* Ajouter les recettes quand l'utilisateur se connecte
* Designer - Faire moteur de recherche

# Projet Boisson Programmation web S5, 2019-2020

[https://boissons.alexandre-hublau.com](https://boissons.alexandre-hublau.com)

Nous utiliserons le micro-framework Slim pour ce qui est de la partie routage.
Tout le reste est entièrement codé par nos soins, il n'y aura donc pas d'utilisation de framework faisant tout le travail à notre place.

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

Les mots de passe sont chiffrés

Lorsque les utilisateurs choisissent des recettes:
* Si l'utilisateur n'est pas connecté, alors les recettes sont sauvegardées dans la session
	* Si l'utilisateur se connecte, alors les recettes ajoutées précédement ainsi que les recettes qu'il avait sont ajoutés à son compte (merge)
	* Si l'utilisateur se déconnecte, alors les recettes sont effacées de sa session (mais pas de son compte !)
	* Si l'utilisateur connecté supprime les recettes, alors elles sont supprimées de son compte et sa session
	* Si l'utilisateur non connecté supprime les recettes, alors elles sont supprimées de sa session

## Ajouts

* Nous avons ajouté les messages flash pour prévenir l'utilisateur s'il a fait une action.
