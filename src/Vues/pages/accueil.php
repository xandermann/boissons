<h1><?= $categorie ?></h1>

<p>Todo: Afficher le chemin</p>

<?php if(array_key_exists('super-categorie', $hierarchie)): ?>
	<div class="box">

		<h2>Super catégorie</h2>
		<ul>
			<?php foreach($hierarchie['super-categorie'] as $superCategorie): ?>
				<li><a href="index.php?page=accueil&categorie=<?= str_replace(" ", "_", $superCategorie) ?>">
					<?= $superCategorie ?>
				</a></li>
			<?php endforeach; ?>
		</ul>

	</div>
<?php endif ?>


<?php if(array_key_exists('sous-categorie', $hierarchie)): ?>
	<div class="box">

		<h2>Sous cagégorie</h2>

		<ul>
			<?php foreach($hierarchie['sous-categorie'] as $id => $sousCategorie): ?>
				<li><a href="index.php?page=accueil&categorie=<?= str_replace(" ", "_", $sousCategorie) ?>">
					<?= $id ?> - <?= $sousCategorie ?>
				</a></li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>



<?php if($recettes != []): ?>
	<div class="box">
		<h2>Liste de toutes les recettes avec <?= $categorie ?></h2>

		<?php foreach($recettes as $id => $recette): ?>
			<h3><?= $recette['titre'] ?> <a href="index.php?page=ajouter_recette&id=<?= $id ?>">Ajouter cette recette</a></h3>
			<p><?= $recette['ingredients'] ?></p>
			<p><?= $recette['preparation'] ?></p>

			<ul>
				<?php foreach($recette['index'] as $ingredient): ?>
					<li><?= $ingredient ?></li>
				<?php endforeach ?>
			</ul>

			<?php
			$file = str_replace(" ", "_", "Photos/$recette[titre].jpg");

			if(file_exists($file)) { ?>
				<img src="<?= $file ?>" alt="<?= $recette['titre'] ?>">
			<?php } else { ?>
				<img src="Photos/louis.jpg" alt="">
			<?php } ?>

			<hr>
		<?php endforeach ?>

	</div>
<?php endif ?>
