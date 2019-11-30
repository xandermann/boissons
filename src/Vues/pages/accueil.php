<h1><?= $categorie ?></h1>

<?php if(array_key_exists('super-categorie', $hierarchie)): ?>
	<h2>Revenir en arrière</h2>
	<ul>
		<?php foreach($hierarchie['super-categorie'] ?? [] as $superCategorie): ?>
			<li><?= $superCategorie ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif ?>

<h2>Voir un aliment plus précis</h2>
<ul>
	<?php foreach($hierarchie as $nom => $h): ?>
		<li><?= $nom ?>
		<ul>
			<?php foreach($h as $id => $categorie): ?>
				<li>ID:<?= $id ?> - <?= $categorie ?> <a href="index.php?page=accueil&categorie=<?= $categorie ?>">LIEN</a></li>
			<?php endforeach ?>
		</ul>
	</li>
<?php endforeach ?>
</ul>

