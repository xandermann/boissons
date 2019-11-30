<h1><?= $categorie ?></h1>

<?php if(array_key_exists('super-categorie', $hierarchie)): ?>
	<h2>Super catégorie</h2>
	<ul>
		<?php foreach($hierarchie['super-categorie'] as $categorie): ?>
			<li><a href="index.php?page=accueil&categorie=<?= $categorie ?>"><?= $categorie ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php endif ?>


<?php if(array_key_exists('sous-categorie', $hierarchie)): ?>
	<h2>Sous cagégorie</h2>

	<ul>
		<?php foreach($hierarchie['sous-categorie'] as $id => $categorie): ?>
			<li><a href="index.php?page=accueil&categorie=<?= $categorie ?>"><?= $id ?> - <?= $categorie ?></a></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>
