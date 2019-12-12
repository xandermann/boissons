<h1>Mes recettes preferees</h1>

<?php if(count($recettes) > 0){ ?>
	<ul>
		<?php foreach($recettes as $id => $recette): ?>
			<li>
				<h2><?= $recette['titre'] ?></h2>
				<p><a href="index.php?page=supprimer_recette&id=<?= $id ?>">Supprimer</a></p>
				<!-- <?= $recette['ingredients'] ?> <?= $recette['preparation'] ?> -->
			</li>
		<?php endforeach ?>
	</ul>

	<a href="?page=supprimer_recettes">Supprimer toutes les recettes</a>
	<a href="?page=voir_recette&id=<?= $id ?>">Supprimer toutes les recettes</a>

<?php } else { ?>

	<h3>Pas de recette preferees :(</h3>

<?php } ?>
