HUBLAU Alexandre
MATUCHET Louis

# Projet Boisson Programmation web S5, 2019-2020

Nous utiliserons le micro-framework Slim pour ce qui est de la partie routage.
Tout le reste est entièrement codé par nos soins, il n'y aura donc pas d'utilisation de framework faisant tout le travail à notre place.

## L'arborescence se fait de cette manière :
	- fichier "src" avec toutes les sources php. 
	- fichier "public" avec l'"index.php", les fichiers javascript ainsi que toutes les images

## Choix

Nous avons préféré que l'utilisateur clique plusieurs fois pour pouvoir voir des boissons car dans le cas ou le fichier de données est lourd et que l'utilisateur a une mauvaise connection le temps de chargement pourrait être long.

L'existence de public évite que l'utilisateur ne puisse pas voyager dans toute l'arborescence de fichiers. Sa vision sera limitée à ce seul document ce qui permet entre autre que s'il y a des données plus ou moins sensibles dans un autre dossier il ne pourra y accéder.

Pas de base de données car pas obligatoire et surtout évitable.
