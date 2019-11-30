<h1><?= $categorie ?></h1>

<p>Todo: Afficher le chemin</p>

<?php if(array_key_exists('super-categorie', $hierarchie)): ?>
	<h2>Super catégorie</h2>
	<ul>
		<?php foreach($hierarchie['super-categorie'] as $superCategorie): ?>
			<li><a href="index.php?page=accueil&categorie=<?= $superCategorie ?>"><?= $superCategorie ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php endif ?>


<?php if(array_key_exists('sous-categorie', $hierarchie)): ?>
	<h2>Sous cagégorie</h2>

	<ul>
		<?php foreach($hierarchie['sous-categorie'] as $id => $sousCategorie): ?>
			<li><a href="index.php?page=accueil&categorie=<?= $sousCategorie ?>"><?= $id ?> - <?= $sousCategorie ?></a></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>


<hr><hr><hr><hr><hr>

<h2>Liste de toutes les recettes avec <?= $categorie ?></h2>

<?php foreach($recettes as $recette): ?>
	<h3><?= $recette['titre'] ?></h3>
	<p><?= $recette['ingredients'] ?></p>
	<p><?= $recette['preparation'] ?></p>

	<ul>
		<?php foreach($recette['index'] as $ingredient): ?>
			<li><?= $ingredient ?></li>
		<?php endforeach ?>
	</ul>

	<?php
	$file = "Photos/$recette[titre].jpg";
	$file = str_replace(" ", "_", $file);

	if(file_exists($file)): ?>
		<img src="<?= $file ?>" alt="<?= $recette['titre'] ?>">
	<?php endif ?>

	<hr>
<?php endforeach ?>
