<h1>Mes recettes preferees</h1>

<ul>
	<?php foreach($recettes as $recette): ?>
		<li>
			<h2><?= $recette['titre'] ?></h2>
			<p>Supprimer</p>
			<!-- <?= $recette['ingredients'] ?> <?= $recette['preparation'] ?> -->
		</li>
	<?php endforeach ?>
</ul>
