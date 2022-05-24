<h1><?= $recette['titre'] ?></h1>

<a href="?page=ajouter_recette&id=<?= $id ?>">Ajouter la recette</a>

<h2>Liste des ingredients</h2>
<p><?= $recette['ingredients'] ?></p>

<h2>Preparation</h2>
<p><?= $recette['preparation'] ?></p>
