<h1>Mes recettes preferees</h1>

<ul>
	<?php foreach($recettes as $id => $recette): ?>
		<li>
			<h2><?= $recette['titre'] ?></h2>
			<p><a href="index.php?page=supprimer_recette&id=<?= $id ?>">Supprimer</a></p>
			<!-- <?= $recette['ingredients'] ?> <?= $recette['preparation'] ?> -->
		</li>
	<?php endforeach ?>
</ul>
